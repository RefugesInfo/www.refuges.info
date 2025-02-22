# A exécuter de temps en temps pour mettre à jour les fichiers geoip
cd www.refuges.info
wget -qO- https://mailfud.org/geoip-legacy/GeoIP.dat.gz | gzip -d > ressources/geoip/GeoIP.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPv6.dat.gz | gzip -d > ressources/geoip/GeoIPv6.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPCity.dat.gz | gzip -d > ressources/geoip/GeoIPCity.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPCityv6.dat.gz | gzip -d > ressources/geoip/GeoIPCityv6.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPASNum.dat.gz | gzip -d > ressources/geoip/GeoIPASNum.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPASNumv6.dat.gz | gzip -d > ressources/geoip/GeoIPASNumv6.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPISP.dat.gz | gzip -d > ressources/geoip/GeoIPISP.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPISPv6.dat.gz | gzip -d > ressources/geoip/GeoIPISPv6.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPOrg.dat.gz | gzip -d > ressources/geoip/GeoIPOrg.dat
wget -qO- https://mailfud.org/geoip-legacy/GeoIPOrgv6.dat.gz | gzip -d > ressources/geoip/GeoIPOrgv6.dat
