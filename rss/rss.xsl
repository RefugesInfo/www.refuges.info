<?xml version="1.0" encoding="ISO-8859-1"?>
 <xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html" version="4" encoding="iso-8859-1" indent="yes" />

 <xsl:template match="channel">
  <html xml:lang="fr">

   <head>
      <title>
      	<xsl:value-of select="title" /> 
      </title>
   </head>

   <body>
    <div align="center">
     <a href="#" target="_self">[Recharger]</a> <br />
     <em>Ce fichier <a href="http://fr.wikipedia.org/wiki/Really_Simple_Syndication">RSS</a> n'est pas fait pour être lu dans un navigateur.<br /> Pour pouvoir vous abonner au flux RSS de notre site, et ainsi être tenu au courant de nos nouveautés dès qu'elles sont publiées, vous pouvez télécharger un aggregateur ou utiliser un navigateur qui reconnait ces flux comme Firefox, Safari, Opera ou Internet Explorer 7 (appelés "marques pages dynamiques" sous FireFox)</em>
     
     <h2>
      <a href="{link}">
       <xsl:value-of select="title" /> 
      </a>
     </h2>

     <a href="{image/link}" target="_blank">
      <img src="{image/url}" alt="{image/title}" title="{description}" border="0" /> 
     </a>
      <center><xsl:value-of select="description" /></center>

     <ul>
       <xsl:call-template name="lesitems" /> 
     </ul>

    </div>
   </body>
  </html>
 </xsl:template>




 <xsl:template match="item" name="lesitems">
  <xsl:for-each select="item">
	<br />
	<li><a href="{link}" title="{description}">
		<xsl:value-of select="title" /></a>
	    <br />
	    <xsl:value-of select="description" /> 
	    &gt; 
		<a href="{link}" target="_blank">voir</a> 
	    &lt;
	</li>
  </xsl:for-each>
 </xsl:template>
 
</xsl:stylesheet>
