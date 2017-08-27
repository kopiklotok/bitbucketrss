function create {

  rm -rf .git
  heroku create $1
  git init

  git config --global user.email "alba.cierr4@gmail.com"
  git config --global user.name "Nyonya Soekarni"

  git remote add origin https://git.heroku.com/$1.git
  git add .
  git add bots/
  git commit -m 'ready'
  git push -f origin master

  heroku ps:scale web=1 worker=0

}

function deploy {

  echo $1;

  git add .
  git add bots/
  git commit -m 'ready'
  git push origin master

  heroku ps:scale web=1 worker=0

}

if [ -n "$1" ]; then
  create $1
  echo 'let'
else
  deploy
  echo 'done'
fi
