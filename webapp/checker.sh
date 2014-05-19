#/bin/bash

ipnya="$1"
prefix=$(echo $ipnya | sed 's/\.[0-9]*$//')
dofile="do/$1"
donefile="done/$1"

mkdir -p "do" "done"
rm do/* > /dev/null 2>&1
rm done/* > /dev/null 2>&1

echo "" > "do/index.html"
echo "" > "done/index.html"
echo -n "" > "$dofile"
echo -n "0" > "$donefile"

sort_ip() {
  sort -n -t . -k 1,1 -k 2,2 -k 3,3 -k 4,4 "$dofile" > "$dofile.tmp"
  rm "$dofile" && mv "$dofile.tmp" "$dofile"
}

linkify() {
  cat "$dofile" | sed 's/^/<div class="col-xs-6 col-sm-4 col-md-3"><a class="btn btn-primary btn-block" href="http:\/\//g' | sed 's/$/\/" target="_blank">/g' > "$dofile.tmp"
  paste "$dofile.tmp" "$dofile" | sed 's/$/<\/a><\/div>/g' > "$dofile.temp"
  rm "$dofile" "$dofile.tmp"
  mv "$dofile.temp" "$dofile"
}

fping -agq "$prefix.1" "$prefix.255" 2> /dev/null >> "$dofile" &

PID=$!
sleep 30
PSPID=$(ps | grep $PID | grep -v grep)
if [ "$PSPID" != "" ]; then
  # macet
  kill $PID > /dev/null 2>&1
  sort_ip
  linkify
else
  sort_ip
  linkify
fi

echo -n "done" > "$donefile"