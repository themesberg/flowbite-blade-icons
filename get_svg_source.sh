#!/bin/bash

clone_temp="./git_clone_temp"
svg_temp="./svg_temp"
url_github="https://github.com/themesberg/flowbite-icons.git"

rm -rf "$clone_temp"
rm -rf "$svg_temp"

mkdir -p "$clone_temp"
mkdir -p "$svg_temp"

git clone "$url_github" "$clone_temp"

mv "$clone_temp/src"/* "$svg_temp"
rm -rf "$clone_temp"

rm -rf "resources/svg"
./vendor/bin/blade-icons-generate
rm -rf "$svg_temp"
