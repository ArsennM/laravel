<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <style>
        #searchResults {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 5px;
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
        }
        
        #searchResults div {
            padding: 5px;
            cursor: pointer;
        }
        
        #searchResults div:hover {
            background-color: #ddd;
        }
    </style>


</head>

<body>
    <div class="header">
        <div class="logo">
            <span>Instagram</span>
        </div>
        <div id="iconsDiv" class="iconsDiv">




            <div><label><a href="{{ route ('profile', ['id' => auth()->user()->id]) }}"><i class="fa fa-home" aria-hidden="true"></i></a>
</label></div>
            <div><label ><a href="{{ route('allPost') }}"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a><span>Reels</span></label></div>
            <div><span style="display: flex; align-items: center;" id="messages"><a  href="{{ route('message.allChats') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i></a><span>Messages</span></span></div>
            <div><span style="display: flex; align-items: center;" id="notifications"><a href="{{ route ('notifications') }} "><i class="fa fa-heart-o" aria-hidden="true"></i></a><span>Notifications</span></span></div>
            <div><span style="display: flex; align-items: center;" id="create"><a href="{{ route('post.createForm') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
</a>Create</span><input type="hidden" id="addPostRoute" ></div>
            <div><span style="display: flex; align-items: center;" id="change"><a href="{{route('change-name')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>Change</span></div>
            <div><span style="display: flex; align-items: center;" id="users"><a href="{{route('users')}}"><i class="fa fa-users" aria-hidden="true"></i></a>Users</span></div>
            <div><span style="display: flex; align-items: center;" id="users"><a href="{{route('save.photos')}}"><i class="fa fa-bookmark" aria-hidden="true"></i>
            </a>Saved</span></div>

            <form method="POST" action="{{ route('login') }}"><span style="display: flex; align-items: center;" id="users"><a href="{{route('login')}}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>Log Out</span></form>



        </div>

    </div>


<div class="search-container">
    <input type="text" id="searchInput" placeholder="Поиск пользователей...">
    <div id="searchResults" class="search-results"></div>
</div>

<!-- <script>
    function searchUsers(event) {
        var searchQuery = event.target.value.trim();

        if (searchQuery === '') {
            document.getElementById('searchResults').style.display = 'none';
            return;
        }

        fetch('/users/search?query=' + encodeURIComponent(searchQuery))
            .then(response => response.json())
            .then(users => {
                displaySearchResults(users);
            })
            .catch(error => {
                console.error('Ошибка при выполнении запроса:', error);
            });
    }


    




    function displaySearchResults(results) {
        var searchResultsDiv = document.getElementById('searchResults');
        searchResultsDiv.innerHTML = ''; 

        results.forEach(function(user) {
            var userDiv = document.createElement('div');
            userDiv.textContent = user.name; 
            userDiv.classList.add('search-result-item');

            userDiv.addEventListener('click', function() {
                window.location.href = '/profile/' + user.id;
            });

            searchResultsDiv.appendChild(userDiv);
        });

        searchResultsDiv.style.display = results.length > 0 ? 'block' : 'none';
    }



function subscribeToUser(userId) {
    fetch('/follow/' + userId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        updateSubscriptionButton(userId, true);
    })
    .catch(error => {
        console.error('Ошибка при подписке:', error);
    });
}

function unsubscribeFromUser(userId) {
    fetch('/unfollow/' + userId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        updateSubscriptionButton(userId, false);
    })
    .catch(error => {
        console.error('Ошибка при отписке:', error);
    });
}

function updateSubscriptionButton(userId, isFollowing) {
    var userDiv = document.querySelector('.search-result-item[data-user-id="' + userId + '"]');
    var subscribeButton = userDiv.querySelector('.subscribe-button');
    subscribeButton.textContent = isFollowing ? 'Вы подписаны' : 'Подписаться';
}

var searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', searchUsers);




    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', searchUsers);
</script> -->


<script>
        function searchUsers(event) {
            var searchQuery = event.target.value.trim();

            if (searchQuery === '') {
                document.getElementById('searchResults').style.display = 'none';
                return;
            }

            fetch('/users/search?query=' + encodeURIComponent(searchQuery))
                .then(response => response.json())
                .then(users => {
                    displaySearchResults(users);
                })
                .catch(error => {
                    console.error('Ошибка при выполнении запроса:', error);
                });
        }

        function displaySearchResults(results) {
    var searchResultsDiv = document.getElementById('searchResults');
    searchResultsDiv.innerHTML = '';

    results.forEach(function(user) {
        var userDiv = document.createElement('div');
        userDiv.textContent = user.name;
        userDiv.classList.add('search-result-item');


        userDiv.addEventListener('click', function() {
            window.location.href = '/profile/' + user.id;
        });

        searchResultsDiv.appendChild(userDiv);
    });

    searchResultsDiv.style.display = results.length > 0 ? 'block' : 'none';
}





        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', searchUsers);
    </script>



</body>
</html>