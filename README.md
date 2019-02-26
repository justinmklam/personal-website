# Personal Project Website
Increasing my online presence by showcasing projects that I've worked on over the years. 

# Dependencies
+ Static website created using Hugo engine
+ Theme template created using Bootstrap framework

# How To Use
## Basic Hugo commands
To compile the website where output is in 'docs' folder:
```
hugo
```
or to include drafts,
```
hugo -D
```
To start a local server for live website testing (at localhost:1313):
```
hugo -D serve
```
## Adding Content
To create a new project post in the 'content' folder:
```
hugo new /projects/[PROJECT TYPE]/[TITLE].md
```
To create a new blog post:
```
hugo new /posts/[YEAR]/[MONTH]/[TITLE].md
```
__Note:__ Upload project images, files, etc. in the `static` directory.

## Publishing through GitHub Pages
Github will publish the 'docs' folder in this repo. Configure the Hugo publish directory in config.toml for easy publishing. 

```
publishdir = "docs"
```

Follow the [Hugo Quickstart Guide](https://gohugo.io/overview/quickstart/) for more details.

# Namecheap Setup for Custom Domain
These settings are managed under the `Advanced DNS` tab. See [GitHub Help](https://help.github.com/en/articles/setting-up-an-apex-domain#configuring-a-records-with-your-dns-provider) for details.

| Type | Host | Value | TTL |
|---|---|---|---|
| A Record | @ | 185.199.108.153 | Automatic |
| A Record | @ | 185.199.109.153 | Automatic |
| A Record | @ | 185.199.110.153 | Automatic |
| A Record | @ | 185.199.111.153 | Automatic |
| CNAME Record | www | justinmklam.github.io. | Automatic |
| TXT Record | @ | google-site-verification=[KEY] | Automatic |
