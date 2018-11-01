Bash
-

````
bash --version
echo $BASH_VERSION

PATH=$PATH:~/bin

type cp
type /Users/k/web/kovpak/gh/ed/bash/examples/hw.sh
````

````bash
# shabang:
#!/bin/bash
#!/usr/bin/env php
#!/usr/bin/env python3

$0   # name of called script
$1   # 1st script parameter
$2   # 2nd
"$@" # all script parameters (+ quotes)
$*   # all script parameters
$#   # number of script parameters
$?   # exit status for last command

# shift:
$2 -> $1
$3 -> $2
$4 -> $3

echo $(date)
echo '$myVar' # not evaluate vars
echo "$myVar" # evaluate
echo $USER

read -p "Your note: " note

if [[ $str ]];           # str isn't empty
if [[ $str = "txt" ]];   # str equals "txt"
if [[ $str="txt" ]];     # always true
if [[ $str = [Yy] ]];    # Y || y
if [[ $str == *.txt ]];  #
if [[ ! $1 ]];           # $1 is empty
if [[ -e $file ]];       # file exists
if [[ -d $dir ]];        # is directory
if [[ $1 =~ ^[0-9]+$ ]]; # is number
&& # &
|| # or

exit 0 # success
exit 1 # fail

# set Input Field Separator, by default ` ` (space)
IFS=:

[[ hello = h*o ]] && echo yes
[[ heeello =~ (e+) ]] && echo "yes, because: ${BASH_REMATCH[1]}"
[[ $1 ]] || { echo "missing argument" >&2; exit 1; }
{ cat x.txt || echo "file x.txt not found"; } 2>/dev/null

# default value
declare y=${myDefVar:-"nil"}
echo $y # nil
myDefVar=null
declare y=${myDefVar:-"nil"}
echo $y # null

# end of options:
touch -a # error
touch -- -a # ok

set -e # exit whenever a command fails
set -n # validate but not exec script
set -o #
set -u # error when using uniinitialized var
set -v #
set -v # print each command
set -x # to start debug

declare -i # interger
declare -r # readonly
declare -x # export

````

#### Debug:

````bash
#!/bin/bash -x

# or
set -x # to start debug
set +x # to end debug

# or
bash -x /Users/k/web/kovpak/gh/ed/bash/examples/hw.sh
````

#### Strings:

````bash
${#var} # string length

s="http://host/json_path.json"
echo ${s#htt?}        # ://host/json_path.json
echo ${s#*/}          # /host/json_path.json
echo ${s##*/}         # json_path.json
echo ${s%.*}          # http://host/json_path
echo ${s%/*}          # http://host
echo ${s%%/*}         # http:
echo ${s/json/yaml}   # http://host/yaml_path.json
echo ${s/%json/yaml}  # http://host/json_path.yaml
echo ${s/.json/}      # http://host/json_path
echo ${s%.json}       # http://host/json_path
echo ${s//[o]/X}      # http://hXst/jsXn_path.jsXn

````

#### Numbers:

````bash
-eq
-ne
-le
-gt
# don't use =,<,> for numbers

declare -i p
p="4+5"
echo $p # 9
p="ok"
echo $p # 0
$((++p))
echo $p # 1

declare -ir const=$(( 1 + 1))
echo $const
const=3 # -bash: const: readonly variable

declare -x var="outer" # export var for inluded scripts
````

#### Array:

````bash
declare -a ar=("element1" "element2" "element3")
declare -p ar # declare -a ar='([0]="element1" [1]="element2" [2]="element3")'

arr=(1 2 3 a b)
echo ${#arr[@]} # array length
echo ${!arr[@]} # array indices
````

#### Function:

````bash
# in case no return in function
# return value will be return value from last function's line of code
startsWithA() {
  [[ $1 == [Aa]* ]];
}

error() {
  echo "Error: $1"
  exit 1
} >&2

foo() { bar; }
export -f foo
env | grep -A1 foo

export foo='() { echo "Inside function"; }'
bash -c 'foo'

export foo='() { echo "Inside function" ; }; echo "Executed echo"'
bash -c 'foo'

export dummy='() { echo "hi"; }; echo "pwned"'
$ bash
pwned
````

#### Loop:

````bash
break
continue

while test; do
    ;; code
done

until test; do
    ;; code
done

for el in arr; do
    ;; code
done
for f in *"$1"; do
    echo "$f $1"
done
for (( init; test; update )); do
    ;; code
done
````