heroku create $1
DATE=`date +%Y-%m-%d`
git init
git remote add origin https://git.heroku.com/$1.git
git add .
#echo "Commit Message:"
#read commit
git commit -m $DATE
git push -u origin master
heroku ps:scale web=1 worker=1
