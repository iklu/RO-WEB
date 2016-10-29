git commit -a -m "Pre .gitignore changes"
git rm -r --cached .
git add .
git commit -a -m "Post .gitignore changes"
git status should output "nothing to commit (working directory clean)" `
