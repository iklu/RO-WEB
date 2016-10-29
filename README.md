GIT IGNORE

- git commit -a -m "Pre .gitignore changes"
- git rm -r --cached .
- git add .
- git commit -a -m "Post .gitignore changes"
- git status should output "nothing to commit (working directory clean)" 

PERMISSIONS

- $ HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
- # if this doesn't work, try adding `-n` option
- $ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
- $ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
