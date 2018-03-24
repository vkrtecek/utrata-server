#!/bin/bash
FILE="tmp.ftp"
dirs="app bootstrap config public routes storage"

set x # print each command

echo "ftp -n $FTP_HOST <<END_FTP" > "$FILE"
echo "quote USER $FTP_USER" >> "$FILE"
echo "quote PASS $FTP_PASS" >> "$FILE"
echo "passive" >> "$FILE"


for i in $(find $dirs); do
    if [ -f "$i" ]; then
        echo "put $i public_html/api/$i" >> "$FILE"
    elif [ -d "$i" ]; then
        echo "mkdir public_html/api/$i" >> "$FILE"
    fi
done

filesInRoot=".htaccess"
for i in $filesInRoot; do
    echo "put $i public_html/api/$i" >> "$FILE"
done

if [ "$APP_KEY" != "" ]; then
    #setting environmental variables
    cp .env.example .env
    sed -i "s|^APP_KEY=.*$|APP_KEY=$APP_KEY|" .env
    sed -i "s|^DB_DATABASE=.*$|DB_DATABASE=$MYSQL_DB_NAME|" .env
    sed -i "s|^DB_USERNAME=.*$|DB_USERNAME=$MYSQL_USERNAME|" .env
    sed -i "s|^DB_PASSWORD=.*$|DB_PASSWORD=$MYSQL_ROOT_PASSWORD|" .env

    echo "put .env public_html/api/.env" >> "$FILE"
fi

echo "quit" >> "$FILE"
echo "END_FTP" >> "$FILE"
chmod 777 "$FILE"
cat "$FILE"
./"$FILE"
rm "$FILE"