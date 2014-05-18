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

echo "IP tetangga yang online: " >> "$dofile"
echo "<br>" >> "$dofile"

fping -agq "$prefix.1" "$prefix.255" 2> /dev/null > "$dofile" &

PID=$!
sleep 30
PSPID=$(ps | grep $PID | grep -v grep)
if [ "$PSPID" != "" ]; then
  # macet
  kill $PID > /dev/null 2>&1
fi

# linkify


echo -n "done" > "$donefile"
