<?php
// Affichage des traductions automatiques des messages et titres du forum (table `traductions`, type_objet = 'post_forum').
// Extension autonome : aucun fichier du coeur de phpBB n'est modifié, tout passe par les événements (core.*).
//  - champ 'texte'       : id_objet = post_id  ; texte au même format que phpbb3_posts.post_text (XML s9e)
//  - champ 'titre_sujet' : id_objet = topic_id ; texte brut échappé comme phpbb3_topics.topic_title
// Une traduction n'est utilisée que si hash_source = md5(source actuelle) : source modifiée => retour à l'original.
// Langue : celle du forum ($user->lang_name, posée par l'extension couplage d'après le cookie "langue"). En français : rien ne change.

namespace RefugesInfo\traduction\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
  // pack de langue phpBB => code de la colonne traductions.langue
  const LANGUES = ['en' => 'en', 'de' => 'de', 'it' => 'it', 'es_x_tu' => 'es'];

  // Libellés de la mention (les 4 langues du pilote ; à passer en fichiers language/ si l'extension est conservée)
  const MENTION = [
    'en' => ['Auto-translated', 'Automatically translated; click to see the original text'],
    'de' => ['Automatisch übersetzt', 'Automatisch übersetzt; klicken, um den Originaltext zu sehen'],
    'it' => ['Trad. auto', 'Tradotto automaticamente; clicca per vedere il testo originale'],
    'es' => ['Trad. automática', 'Traducido automáticamente; haz clic para ver el texto original'],
  ];

  protected $db;
  protected $user;
  protected $cache_texte = [];  // post_id  => ['texte'=>, 'hash'=>, 'src'=>] | null
  protected $cache_titre = [];  // topic_id => ['texte'=>, 'hash'=>] | null

  public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user)
  {
    $this->db = $db;
    $this->user = $user;
  }

  static public function getSubscribedEvents()
  {
    return [
      'core.viewtopic_get_post_data'               => 'viewtopic_prefetch',
      'core.viewtopic_modify_post_row'             => 'viewtopic_post',
      'core.viewtopic_modify_page_title'           => 'viewtopic_titre',
      'core.viewforum_modify_topicrow'             => 'viewforum_topic',
      'core.display_forums_modify_template_vars'   => 'index_forum',
      'core.search_modify_tpl_ary'                 => 'search_ligne',
    ];
  }

  // Code de langue cible, ou null (français, ou langue sans traduction)
  protected function langue()
  {
    return self::LANGUES[$this->user->lang_name] ?? null;
  }

  protected function charge($champ, array $ids, $langue)
  {
    $ids = array_map('intval', $ids);
    $res = array_fill_keys($ids, null);
    if (!$ids) return $res;
    $sql = "SELECT id_objet, texte, langue_source, hash_source FROM traductions
      WHERE type_objet = 'post_forum' AND champ = '".$this->db->sql_escape($champ)."' AND langue = '".$this->db->sql_escape($langue)."'
      AND texte IS NOT NULL AND ".$this->db->sql_in_set('id_objet', $ids);
    $r = $this->db->sql_query($sql);
    while ($l = $this->db->sql_fetchrow($r))
      $res[(int)$l['id_objet']] = ['texte' => $l['texte'], 'hash' => trim($l['hash_source']), 'src' => $l['langue_source']];
    $this->db->sql_freeresult($r);
    return $res;
  }

  // Titre traduit d'un sujet (texte échappé HTML) ou null ; $titre_source = topic_title actuel
  protected function titre($topic_id, $titre_source)
  {
    $langue = $this->langue();
    if (!$langue || !$topic_id) return null;
    if (!array_key_exists($topic_id, $this->cache_titre))
      $this->cache_titre += $this->charge('titre_sujet', [$topic_id], $langue);
    $t = $this->cache_titre[$topic_id];
    return ($t && $t['hash'] === md5($titre_source)) ? $t['texte'] : null;
  }

  // Sujet d'un message : "Re: <titre>" ou "<titre>" suivent la traduction du titre, tout autre sujet reste tel quel
  protected function sujet($sujet, $topic_id, $titre_source)
  {
    $t = $this->titre($topic_id, $titre_source);
    if ($t === null) return $sujet;
    if ($sujet === $titre_source) return $t;
    if ($sujet === 'Re: '.$titre_source) return 'Re: '.$t;
    return $sujet;
  }

  // Texte traduit déjà rendu + original replié
  protected function mention($original_html, $src, $langue)
  {
    [$libelle, $info] = self::MENTION[$langue];
    return '<details class="traduction_auto" style="margin-top:1em;font-size:.9em"><summary title="'.htmlspecialchars($info).'" style="cursor:pointer;opacity:.7">'
      .htmlspecialchars($libelle).(ctype_alpha((string)$src) ? ' '.strtoupper($src) : '').'</summary>'
      .'<div class="traduction_auto_original"'.(ctype_alpha((string)$src) ? ' lang="'.$src.'"' : '').'>'.$original_html.'</div></details>';
  }

  // --- viewtopic -----------------------------------------------------------------------------------------------

  public function viewtopic_prefetch($event)
  {
    $langue = $this->langue();
    if (!$langue) return;
    $ids = array_map('intval', $event['post_list']);
    $this->cache_texte += $this->charge('texte', $ids, $langue);
    $t = $event['topic_data'];
    $this->cache_titre += $this->charge('titre_sujet', [(int)$t['topic_id']], $langue);
  }

  public function viewtopic_post($event)
  {
    $langue = $this->langue();
    $row = $event['row'];
    $post_row = $event['post_row'];
    $topic_data = $event['topic_data'];
    if (!$langue) return;

    $post_row['POST_SUBJECT'] = $this->sujet($row['post_subject'], $row['topic_id'], $topic_data['topic_title']);

    $t = $this->cache_texte[(int)$row['post_id']] ?? null;
    // pas de traduction si le message a des pièces jointes (leur insertion dans le texte n'est pas rejouée ici)
    if ($t && $t['hash'] === md5($row['post_text']) && empty($event['attachments'][$row['post_id']]))
    {
      $flags = ($row['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
      $traduit = generate_text_for_display($t['texte'], $row['bbcode_uid'], $row['bbcode_bitfield'], $flags, true);
      $post_row['MESSAGE'] = $traduit.$this->mention($post_row['MESSAGE'], $t['src'], $langue);
    }
    $event['post_row'] = $post_row;
  }

  // Titre de la page et titre affiché ; topic_data reste intact (le formulaire de réponse rapide garde le titre d'origine)
  public function viewtopic_titre($event)
  {
    global $template;
    $td = $event['topic_data'];
    $t = $this->titre((int)$td['topic_id'], $td['topic_title']);
    if ($t === null) return;
    $t = censor_text($t);
    $template->assign_var('TOPIC_TITLE', $t);
    $event['page_title'] = $t.substr($event['page_title'], strlen(censor_text($td['topic_title'])));
  }

  // --- listes --------------------------------------------------------------------------------------------------

  public function viewforum_topic($event)
  {
    if (!$this->langue()) return;
    $row = $event['row'];
    $tr = $event['topic_row'];
    $t = $this->titre((int)$row['topic_id'], $row['topic_title']);
    if ($t !== null) $tr['TOPIC_TITLE'] = censor_text($t);
    $tr['LAST_POST_SUBJECT'] = censor_text($this->sujet($row['topic_last_post_subject'], (int)$row['topic_id'], $row['topic_title']));
    $event['topic_row'] = $tr;
  }

  // Dernier message d'un forum, sur l'index : on retrouve le sujet à partir de forum_last_post_id
  public function index_forum($event)
  {
    $langue = $this->langue();
    $row = $event['row'];
    if (!$langue || empty($row['forum_last_post_id'])) return;
    $r = $this->db->sql_query('SELECT t.topic_id, t.topic_title FROM '.POSTS_TABLE.' p JOIN '.TOPICS_TABLE.' t ON t.topic_id = p.topic_id WHERE p.post_id = '.(int)$row['forum_last_post_id']);
    $l = $this->db->sql_fetchrow($r);
    $this->db->sql_freeresult($r);
    if (!$l) return;
    $s = $this->sujet($row['forum_last_post_subject'], (int)$l['topic_id'], $l['topic_title']);
    if ($s === $row['forum_last_post_subject']) return;
    $s = utf8_decode_ncr(censor_text($s));
    $fr = $event['forum_row'];
    $fr['LAST_POST_SUBJECT'] = $s;
    $fr['LAST_POST_SUBJECT_TRUNCATED'] = truncate_string($s, 30, 255, false, $this->user->lang['ELLIPSIS']);
    $event['forum_row'] = $fr;
  }

  // Résultats de recherche : titres et sujets seulement (l'extrait affiché reste celui de l'original, voir remarques du pilote)
  public function search_ligne($event)
  {
    if (!$this->langue()) return;
    $row = $event['row'];
    $tpl = $event['tpl_ary'];
    $topic_id = (int)($row['topic_id'] ?? 0);
    if (!$topic_id || empty($row['topic_title'])) return;
    $t = $this->titre($topic_id, $row['topic_title']);
    if ($t !== null) $tpl['TOPIC_TITLE'] = censor_text($t);
    if (isset($tpl['POST_SUBJECT']) && isset($row['post_subject']))
      $tpl['POST_SUBJECT'] = $this->sujet($row['post_subject'], $topic_id, $row['topic_title']);
    if (isset($tpl['LAST_POST_SUBJECT']) && isset($row['topic_last_post_subject']))
      $tpl['LAST_POST_SUBJECT'] = censor_text($this->sujet($row['topic_last_post_subject'], $topic_id, $row['topic_title']));
    $event['tpl_ary'] = $tpl;
  }
}
