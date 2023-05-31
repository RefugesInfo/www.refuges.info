#!/bin/bash
cut -f1-5 -d\; $1 | sed s/";;"/" -> "/g | sed s/";"/" "/g | grep -v robots.txt