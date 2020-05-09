{% extends 'layout/main.volt' %}

{% block content %}



<div class="row">
    <div class="col-md-2" style="background-color: #BC9CB0; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% if (session.has('auth')) %}
        <h4>Hello, {{ session.get('auth')['username'] }}!</h4>
        {% else %}
        <h4>Hello, guest!</h4>
        {% endif %}

        <div class="list-group">
            <a href="/dashboard/search/bytag/0/" class="list-group-item list-group-item-action">Game Dev</a>
            <a href="/dashboard/search/bytag/1/" class="list-group-item list-group-item-action">Android Dev</a>
            <a href="/dashboard/search/bytag/2/" class="list-group-item list-group-item-action">Data Mining</a>
            <a href="/dashboard/search/bytag/3/" class="list-group-item list-group-item-action">TCyber</a>
            <a href="/dashboard/search/bytag/4/" class="list-group-item list-group-item-action">Competitive Programming</a>
          </div>
    </div>
    <div class="col-md-7" style="background-color: #88958D; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% for controller, post in page.getItems() %}
        <a href="/dashboard/post/show/{{post.id}}">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <h1>{{ post.title }}</h1>
                <h6>asked by {{ post.username }} at {{ post.created_at }}</h6>
            </div>
        </a>
        {% endfor %}
        
        <a href="/dashboard" style="color: white;">First</a>
        <a href="/dashboard?page=<?= $page->getPrevious(); ?>" style="color: white;">Previous</a>
        <a href="/dashboard?page=<?= $page->getNext(); ?>" style="color: white;">Next</a>
        <a href="/dashboard?page=<?= $page->getLast(); ?>" style="color: white;">Last</a>

        <p style="color: white;">Page {{ page.getCurrent() }} of {{ page.getLast() }}</p>
    </div>
    <div class="col-md-3" style="background-color: #D3CDD7; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% if (session.has('auth')) %}
        <h3>Ask a new question</h3>
        <a class="btn btn-primary" href="/dashboard/post/new">Ask!</a>
        {% else %}
        <h3>Login now to start asking question in this website!</h3>
        {% endif %}
    </div>
</div>


{% endblock %}