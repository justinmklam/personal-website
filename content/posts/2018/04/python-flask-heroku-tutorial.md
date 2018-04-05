+++
date = "2018-04-03T20:33:46-07:00"
draft = true
image = "/imgs/blog-imgs/python-heroku-tutorial/converter - flask demo.gif"
layout = "single-blog"
tagline = "A journey from Jupyter Notebook to Flask to Heroku, all in one post."
tags = ["programming", "python"]
title = "From Prototype to Cloud: A Python Recipe Converter"
type = "blog"

+++

In case the title wasn't clear, this blog post is about developing a web application using the Python programming language using Jupyter Lab, Flask, and the Heroku platform. If you were looking for an article on python recipes, you can start off with this one on making a [poached Burmese python curry](https://mobile-cuisine.com/recipes/recipe-poached-burmese-python-curry/).

## The Backstory

The problem with online baking recipes is that the majority of them use volumetric units. As any civilized baker would know, Patricia's 1 cup of flour may very well be different than Patrick's 1 cup of flour. Maybe Patricia sifted her flour. Maybe Patrick's organic flour is a finer texture. Maybe both Pats **should measure by mass instead of volume** to avoid all this confusion in the first place.

With this in mind, I was tired of constantly typing "1 tbsp baking soda in grams" and "3 1/4 cup flour in grams" into Google every time I came across a new recipe. There had to be a better way, and there was. As usual, Python was staring, patiently waiting for me to make eye contact with it.

My main reqiurement for this application was to be cross-platform. I wanted to be able to carry these conversions out on my laptop, someone else's desktop, or my smartphone. Although [React](https://reactjs.org/) is what all the cool kids talk about these days, I also wanted to develop something fast. Since Python is both excellent at string parsing and easy to work with, it seemed like an appropriate choice.

After a bit of searching, I came across [Flask](http://flask.pocoo.org/) and [Heroku](https://www.heroku.com/python) which would allow me to use Python for the entire development process, from prototype to deployment. Super cool.

## The Outline

This blog post will outline the development of a simple string-parsing application that converts common ingredients measured in cups, tablespoons, and teaspoons to grams. 

+ Prototype the recipe conversions in [Jupyter Lab's](https://blog.jupyter.org/jupyterlab-is-ready-for-users-5a6f039b8906) interactive environment
+ Migrate script to [Visual Studio Code](https://code.visualstudio.com/) to a command line interface
+ Integrate the Python script with [Flask's web framework](http://flask.pocoo.org/)
+ Set up and deploy the app through the [Heroku cloud platform](https://www.heroku.com/python)

**Interested in trying it out?** It's live at [recipe-converter-app.herokuapp.com](http://recipe-converter-app.herokuapp.com/)!

## The Development

### Prototyping in Jupyter

#### Why Jupyter?

Sure you can do all your development in a text editor and command line. There's nothing wrong with putting print statements everywhere, or even having a Python console open to do scratchpad-type testing. But when a tool as flexible and great as Jupyter is available for everyone to use, why settle for anything else?

> The reason for Jupyter’s immense success is it excels in a form of programming called **"literate programming"**. It emphasizes a prose first approach where exposition with human-friendly text is punctuated with code blocks. It excels at demonstration, research, and teaching objectives - [Unidata](https://unidata.github.io/online-python-training/introduction.html)

The greatest value for me is the option to execute code in chunks and see what the output is at each step. For data science, pairing this with the ability to write markdown above or below the code block makes documentation and explanations a joy to work with.

{{<img caption="The power of Jupyter's interactive output makes prototyping almost effortless." src="/imgs/blog-imgs/python-heroku-tutorial/jupyter demo gif.gif" link="http://n-s-f.github.io/2017/03/25/r-to-python.html" link-text="Noam Finkelstein">}}

{{<img caption="Jupyter Lab is the successor to Jupyter (previously iPython) Notebook. The tabbed interface is a godsend." src="/imgs/blog-imgs/python-heroku-tutorial/jupyter lab.png" link="https://blog.jupyter.org/jupyterlab-is-ready-for-users-5a6f039b8906" link-text="Jupyter">}}

#### On To The Prototype

Working in pieces, I was able to get something up and running. Compare the [current version](https://github.com/justinmklam/recipe-converter/blob/master/Recipe%20Converter%20PoC.ipynb) with [the very first version](https://github.com/justinmklam/recipe-converter/blob/3a4c109a1eb7604cb01cc3f615b37e73e08273ca/.ipynb_checkpoints/Recipe%20Converter-checkpoint.ipynb), and we can see that the code structure went from messy and repetitive to organized and modular.

{{<img caption="Testing out the prototype in Jupyter." src="/imgs/blog-imgs/python-heroku-tutorial/converter - jupyter demo.gif" >}}

{{<img caption="Imperial volume to metric mass (gram) conversions in a csv file, ie. the wrong units to the right ones." src="/imgs/blog-imgs/python-heroku-tutorial/conversions.PNG" >}}

### Migrating to Visual Studio Code

{{<img caption="Exporting from Jupyter Lab to the next phase of development: the command line." src="/imgs/blog-imgs/python-heroku-tutorial/export from jupyter.png" >}}

{{<img caption="A bit of clean up later and the python script is ready to be imported as a module." src="/imgs/blog-imgs/python-heroku-tutorial/vs code.png" >}}


### Integrating with Flask

```
> pip install flask
```

```python
from flask import Flask, request, render_template, flash
import recipeConverter as rc

# Stuff to initialize the Flask app
app = Flask(__name__)
app.config.from_object(__name__)
app.config['SECRET_KEY'] = '7d441f27d441f28567d441f2b6176a'   # this can be anything

# This decorator tells Flask to use this function as a webpage handler/renderer
@app.route('/', methods=['GET', 'POST'])
def hello():
    # Default text to display in the HTML template
    input_text = "Hello world!"

    # Normal page load calls 'GET'. 'POST' gets called when one of the buttons is pressed
    if request.method == 'POST':
        # Check which button was pressed
        if request.form['submit'] == 'Convert':
            input_text = request.form.get("text")
            parse_form_text(input_text)

        elif request.form['submit'] == 'Clear':
            input_text = ''

    # Render the HTML template. input_text gets fed into the textarea variable in the template
    return render_template('form.html', textarea=input_text)

def parse_form_text(text):
    # This is where the magic happens
    recipe = rc.RecipeConverter()

    # split the text to get each line in a list
    text2 = text.split('\n')
    text_converted = recipe.parse_recipe(text2)

    for line in text_converted:
        flash(line)

if __name__ == '__main__':
    app.run()
```

and the html

```html
<div class="page-header">
    <h1>Recipe Converter</h1>
    <p class="lead">Tired of reading recipes in cups, tablespoons, and teaspoons when you just want everything in grams? Paste your recipe in volumetric units in the textbox below, and hit "Convert"!</p>
</div>

<!-- Input column (left) -->
<div class="col-md-6">
    <h2>Input Recipe</h2>
    <p>
        <form action="" id="textform" method="post">
            <textarea name="text">{{textarea}}</textarea>         <!-- Input text box -->
            <br>
            <input type="submit" name="submit" value="Clear">     <!-- "Clear" button -->
            <input type="submit" name="submit" value="Convert">   <!-- "Convert" button -->
        </form>
    </p>
</div>
    
<!-- Output column (right) -->
<div class="col-md-6">
    <h2>Output Recipe</h2>
    <p>
        <!-- Display each converted line from the flash method (from Flask) -->
        {% with messages = get_flashed_messages() %} 
            {% if messages %}
                {% for message in messages %}
                    {{ message }}
                    <br>
                {% endfor %}
            {% endif %} 
        {% endwith %}
    </p>
</div>
```

{{<img caption="Running Flask in Visual Studio Code." src="/imgs/blog-imgs/python-heroku-tutorial/converter - flask demo.gif" >}}

http://flask.pocoo.org/docs/dev/cli/

Alternatively, you can run the script with the commands below as well.

Unix Bash (Linux, Mac, etc.):
```text
$ export FLASK_APP=app.py
$ flask run
```

Windows CMD:

```text
> set FLASK_APP=app.py
> flask run
```

Windows PowerShell:

```text
> $env:FLASK_APP = "app.py"
> flask run
```

Or simply,

```
> python app.py
```

### Deploying on Heroku Cloud

To deploy on Heroku, we need the following files:

+ **app.py** 
    + Flask Python script
+ **Procfile** 
    + Tells Heroku how to run
+ **requirements.txt** 
    + Tells Heroku what modules it needs to install
+ **runtime.txt** 
    + Tells Heroku which version of Python to use

https://devcenter.heroku.com/articles/heroku-cli#download-and-install

```text
> heroku login
```

Procfile

```text
web: gunicorn app:app --log-file=-
```

Procfile.windows

```text
web: python app.py --log-file=-
```

Requirements.txt

```text
gunicorn
Flask
```
Runtime.txt - run `python -V` or `python --version` in command line

```text
python-3.6.4
```

File structure:

```text
  ├── app.py
  ├── Procfile
  ├── requirements.txt
  └── runtime.txt
```

```text
  ├── app.py
  ├** recipe-converter.py
  ├── Procfile
  ├** Procfile.Windows
  ├── requirements.txt
  └── runtime.txt
```

If you're on a Unix system, you only need to run `heroku local web`. However, since gunicorn is a webserver that isn't available on Windows (but is required for Heroku), we need to have a separate Procfile for running it locally. Thus, we need to add `-f procfile.windows` to ensure Heroku uses the correct file.
```
> heroku local web -f procfile.windows
```

```
> git init
> git add .
> git commit -m 'First commit'
```

```
> heroku create recipe-converter-app
```

```
> git push heroku master
```

{{<img caption="Heroku dashboard." src="/imgs/blog-imgs/python-heroku-tutorial/heroku dashboard.PNG" >}}

{{<img caption="The final python app published through Heroku App. Check it out yourself!" src="/imgs/blog-imgs/python-heroku-tutorial/converter - heroku demo.gif" >}}