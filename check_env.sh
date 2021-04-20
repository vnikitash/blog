#!/usr/bin/env bash

CH="`echo $(git diff -U0 .env.example | grep '^[+-][a-zA-Z]')`"
R="`git remote -v | head -n1 | awk '{print $2}' | sed -e 's,.*:\(.*/\)\?,,' -e 's/\.git$//'`"
CH="`echo $CH | tr " " "\n"`"


if [ ! -z "$CH" ]
then
curl -X POST -H "Content-Type: application/json" -d '{"text": "Project:\n'"$R"'\nChanges:\n'"$CH"'"}' https://hooks.slack.com/services/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
      #echo "\$CH is empty"
fi

