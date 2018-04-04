+++
date = "2018-04-03T20:33:46-07:00"
draft = true
image = "/imgs/blog-imgs/python-heroku-tutorial/converter - heroku demo.gif"
layout = "single-blog"
tagline = "A journey from Jupyter Notebook to Flask to Heroku, all in one post."
tags = ["programming", "python"]
title = "Tutorial: Developing Python from Prototype to the Cloud (via Heroku)"
type = "blog"

+++

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

### Prototyping in Jupyter

<!-- {{<img caption="The power of Jupyter's interactive output makes prototyping almost effortless." src="/imgs/blog-imgs/python-heroku-tutorial/jupyter demo gif.gif" link="http://n-s-f.github.io/2017/03/25/r-to-python.html" link-text="Noam Finkelstein">}} -->

{{<img caption="Jupyter Lab is the successor to Jupyter (previously iPython) Notebook. The tabbed interface is a godsend." src="/imgs/blog-imgs/python-heroku-tutorial/jupyter lab.png" link="https://blog.jupyter.org/jupyterlab-is-ready-for-users-5a6f039b8906" link-text="Jupyter">}}

{{<img caption="The power of Jupyter's interactive output makes prototyping almost effortless." src="/imgs/blog-imgs/python-heroku-tutorial/converter - jupyter demo.gif" >}}

{{<img caption="Imperial volume to metric mass (gram) conversions in a csv file, ie. the wrong units to the right ones." src="/imgs/blog-imgs/python-heroku-tutorial/conversions.PNG" >}}

### Using Flask

```python
from flask import Flask, request, render_template, flash
import recipeConverter as rc

app = Flask(__name__)
app.config.from_object(__name__)
app.config['SECRET_KEY'] = '7d441f27d441f28567d441f2b6176a'

@app.route('/', methods=['GET', 'POST'])
def hello():
    input_text = "Hello world!"

    if request.method == 'POST':
        if request.form['submit'] == 'Convert':
            # store the given text in a variable
            input_text = request.form.get("text")

            parse_form_text(input_text)

        elif request.form['submit'] == 'Clear':
            input_text = ''

    return render_template('form.html', textarea=input_text)

def parse_form_text(text):
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
<div class="container">
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

```text
> python app.py
```


### Installing Heroku

https://devcenter.heroku.com/articles/heroku-cli#download-and-install

```text
> heroku login
Enter your Heroku credentials.
Email: adam@example.com
Password (typing will be hidden):
Authentication successful.
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
  ├── Procfile.Windows
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