# Personal Project Website
Increasing my online presence by showcasing projects that I've worked on over the years.

# Dependencies
+ Static website created using Hugo engine
+ Theme template created using Bootstrap framework

# How To Use
## Basic Hugo commands
To compile the website where output is in 'public' folder:
```
hugo -D
```
or
```
hugo --buildDrafts
```
To start a local server for live website testing:
```
hugo server -D
```
## Adding Content
To create a new project post in the 'content' folder:
```
hugo new /posts/[CATEGORY]/[TITLE].md
```
__Note:__ Upload project images, files, etc. in the 'static' folder.

## Publishing through GitHub Pages
Create a branch called 'gh-pages' and push the content in the 'public' folder to it. To regenerate the website after making changes:
```
git add --all
git commit -m "<some change message>"
git push -f origin gh-pages
```
Or follow the [Hugo Quickstart Guide](https://gohugo.io/overview/quickstart/) for more details.
