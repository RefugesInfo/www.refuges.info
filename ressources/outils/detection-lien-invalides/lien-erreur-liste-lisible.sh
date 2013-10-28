#!/bin/bash
cut -f1-5 -d\; bad-links-refuges.info.csv | sed s/";;"/" -> "/g | sed s/";"/" "/g | grep http | grep -v robots.txt | grep -v www.parc-chartreuse.net | grep -v w3