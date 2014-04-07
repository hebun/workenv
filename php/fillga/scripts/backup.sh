#!/bin/sh

if [ $# -gt 1 ]; then
    echo "Too many arguments. Usage: $0 destination" >&2
    exit 1
fi

START=$(date +%s)
echo "started coping..."
rsync -aAXv --delete /* /mnt/archback  --exclude={/dev/*,/proc/*,/sys/*,/tmp/*,/run/*,/mnt/*,/media/*,/lost+found,/home/*/.gvfs,/var/lib/pacman/sync/*,/home/*/.cache/chromium/*}
FINISH=$(date +%s)
echo "total time: $(( ($FINISH-$START) / 60 )) minutes, $(( ($FINISH-$START) % 60 )) seconds"

touch $1/"Backup from $(date '+%A, %d %B %Y, %T')"
