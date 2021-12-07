ALTER TABLE "points" ALTER "en_attente" TYPE boolean,ALTER "en_attente" SET DEFAULT false,ALTER "en_attente" DROP NOT NULL;
ALTER TABLE "points" RENAME "en_attente" TO "cache";
