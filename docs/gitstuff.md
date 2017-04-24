## Git stuff :)

### Kick-off

Either [clone](https://github.com/ovidiubrunet/RO-WEB) or [download](https://github.com/ovidiubrunet/RO-WEB) the repo, and depending on which part of the project you are on, run the commands from there to get the project up and running.

### Guidelines

First off, always make sure you have the latest branch updates:

1. ```git checkout *branch-name*```
2. ```git pull origin *branch-name*```

Next thing, when ready to go, make sure you're developing on a local branch, starting off from your main upstream branch (see above):

1. ```git checkout -b *my-local-branch```

After things are good to go, push your local branch to upstream:

1. If any files were added run `git add -A`;
2. Make sure to commit and leave a message with it: `git commit -am "commit message goes here"`
3. After all steps above are done: `git push origin *my-local-branch`

Next thing would be to merge your local upstream branch with the branch you started off developing:

1. ```git checkout *branch-name```
2. ```git merge --no-ff *my-local-branch```
3. ```git push origin *my-local-branch```

If any conflicts pop-up(hopefully not) make sure to resolve them in your editor and after:

1. Set a commit message with your resolving conflicts `git commit -am "solved conflicts message"`
2. All conflicts solved: `git push origin *my-local-branch`

And thats about it :)

PS. If something fails, this may work: [OhShitGit!](http://ohshitgit.com/) or ask around :)