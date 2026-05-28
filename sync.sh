#!/bin/bash
# Synchronise le Desktop vers htdocs (XAMPP)
rsync -av --delete --exclude='.git' --exclude='sync.sh' \
  /Users/yassinevitullo/Desktop/projetWebProjet/ \
  /Applications/XAMPP/xamppfiles/htdocs/projetWebProjet/
echo "✅ Synchronisation terminée !"
