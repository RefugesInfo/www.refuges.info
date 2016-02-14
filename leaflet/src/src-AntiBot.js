/*
 * Copyright (c) 2014 Dominique Cavailhez
 * N'active pas si l'agent est un robot
 */

if (navigator.userAgent.search (/arach|archiver|bot|crawl|curl|factory|index|partner|rss|seek|search|semantic|scoot|spider|spyder|yandex/i) != -1)
	L.Map.prototype.addLayer = function () {}
