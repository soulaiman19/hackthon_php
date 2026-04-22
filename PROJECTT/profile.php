<?php
require 'auth.php';
requireLogin();
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFILE - SocialBook</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<nav>
  <div class="nav-left">
    <a href="home.php">
    <img src="images/logo.png" class="logo">
    </a>
    <ul>
      <li><img src="images/notification.png"></li>
      <li><img src="images/inbox.png"></li>
      <li><img src="images/video.png"></li>
    </ul>
  </div>

  <div class="nav-right">
    <div class="search-box">
      <img src="images/search.png">
      <input type="text" placeholder="Search">
    </div>
    <div class="nav-user-icon online" onclick="settingsMenuToggle()">
      <img src="images/profile-pic.png">
    </div>
  </div>

  <div class="settings-menu">
    <div class="settings-menu-inner">

      <div class="user-profile">
        <img src="images/profile-pic.png">
        <div>
          <p>AYA</p>
          <a href="profile.php">See your profile</a>
        </div>
        <div id="dark-btn"><span></span></div>
      </div>

      <hr>

      <div class="user-profile">
        <img src="images/feedback.png">
        <div>
          <p>Give feedback</p>
          <a href="#">Help us improve the new design</a>
        </div>
      </div>

      <hr>

      <div class="settings-links">
        <img src="images/setting.png" class="settings-icon">
        <a href="#">Settings & Privacy <img src="images/arrow.png" width="10px"></a>
      </div>

      <div class="settings-links">
        <img src="images/help.png" class="settings-icon">
        <a href="#">Help & Support <img src="images/arrow.png" width="10px"></a>
      </div>

      <div class="settings-links">
        <img src="images/display.png" class="settings-icon">
        <a href="#">Display & Accessibility <img src="images/arrow.png" width="10px"></a>
      </div>

      <div class="settings-links">
        <img src="images/logout.png" class="settings-icon">
        <a href="logout.php">Logout <img src="images/arrow.png" width="10px"></a>
      </div>

    </div>
  </div>
</nav>

<!---------------- PROFILE ---------------->
<div class="profile-container">
  <img src="images/cover.png" class="cover-img">

  <div class="profile-details">
    <div class="pd-left">
      <div class="pd-row">
        <img src="images/profile.png" class="pd-image">
        <div>
          <h3>Naile MONI</h3>
          <p>1000 Friends - 20 mutual</p>
          <img src="images/member-1.png">
          <img src="images/member-2.png">
          <img src="images/member-3.png">
          <img src="images/member-4.png">
        </div>
      </div>
    </div>

    <div class="pd-right">
      <button class="btn"><img src="images/add-friends.png"> Friends</button>
      <button class="btn"><img src="images/message.png"> Message</button>
      <br>
      <a href="#"><img src="images/more.png"></a>
    </div>
  </div>

  <div class="profile-info">

    <!------ LEFT COLUMN ------>
    <div class="Info-col">

      <div class="profile-intro">
        <h3>Intro</h3>
        <p class="intro-text">Believe in yourself and you can do unbelievable things. <img src="images/feeling.png"></p>
        <hr>
        <ul>
          <li><img src="images/profile-job.png"> Director at 99media ltd</li>
          <li><img src="images/profile-study.png"> Studied at University</li>
          <li><img src="images/profile-home.png"> Lives in New York, USA</li>
          <li><img src="images/profile-location.png"> From Los Angeles, USA</li>
          <li><img src="images/profile-location.png"> Joined January 2015</li>
        </ul>
      </div>

      <div class="profile-intro">
        <div class="title-box">
          <h3>Photos</h3>
          <a href="#">All photos</a>
        </div>
        <div class="photo-box">
          <div><img src="images/photo1.png"></div>
          <div><img src="images/photo2.png"></div>
          <div><img src="images/photo3.png"></div>
          <div><img src="images/photo4.png"></div>
          <div><img src="images/photo5.png"></div>
          <div><img src="images/photo6.png"></div>
        </div>
      </div>

      <div class="profile-intro">
        <div class="title-box">
          <h3>Friends</h3>
          <a href="#">All friends</a>
        </div>
        <p>120 (10 mutual)</p>
        <div class="friends-box">
          <div><img src="images/member-1.png"><p>John</p></div>
          <div><img src="images/member-2.png"><p>Noli</p></div>
          <div><img src="images/member-3.png"><p>Nina</p></div>
          <div><img src="images/member-4.png"><p>Alex</p></div>
          <div><img src="images/member-5.png"><p>Mike</p></div>
          <div><img src="images/member-6.png"><p>Sara</p></div>
          <div><img src="images/member-7.png"><p>Emma</p></div>
          <div><img src="images/member-8.png"><p>Tom</p></div>
        </div>
      </div>

    </div>

    <!------ POSTS COLUMN (CENTER) ------>
    <div class="post-col">

        <div class="write-post-container">
  <div class="user-profile">
    <img src="images/profile-pic.png">
    <div>
      <p>John Doe</p>
      <small>Public <i class="fa-solid fa-caret-down"></i></small>
    </div>
  </div>
  <textarea rows="3" placeholder="What's on your mind, John?"></textarea>
  <div class="add-post-links">
    <a href="#"><img src="images/live-video.png">Live Video</a>
    <a href="#"><img src="images/photo.png">Photo/Video</a>
    <a href="#"><img src="images/feeling.png">Feeling</a>
  </div>
</div>

<div class="post-container">
  <div class="post-row">
    <div class="user-profile">
      <img src="images/member-1.png">
      <div>
        <p>Alison Nim</p>
        <span>April 15 at 9:48 AM · <i class="fa-solid fa-globe"></i></span>
      </div>
    </div>
    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
  </div>
  <p class="post-text">
    SUBSCRIBE <span>@EASY TUTORIALS</span> YouTube Channel for more updates
    <a href="#">YouTubeChannel</a>
  </p>
  <img src="images/feed-image-1.png" class="post-img">
  <div class="post-row">
    <div class="activity-icons">
      <div><img src="images/like-blue.png">120</div>
      <div><img src="images/comments.png">45</div>
      <div><img src="images/share.png">20</div>
    </div>
    <div class="post-profile-incon">
      <img src="images/profile-pic.png"> <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>
</div>

<div class="post-container">
  <div class="post-row">
    <div class="user-profile">
      <img src="images/member-2.png">
      <div>
        <p>jak</p>
        <span>April 20 at 11:48 PM · <i class="fa-solid fa-globe"></i></span>
      </div>
    </div>
    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
  </div>
  <p class="post-text">
    SUBSCRIBE <span>@EASY TUTORIALS</span> YouTube Channel for more updates
    <a href="#">YouTubeChannel</a>
  </p>
  <img src="images/feed-image-2.png" class="post-img">
  <div class="post-row">
    <div class="activity-icons">
      <div><img src="images/like.png">120</div>
      <div><img src="images/comments.png">45</div>
      <div><img src="images/share.png">20</div>
    </div>
    <div class="post-profile-incon">
      <img src="images/profile-pic.png"> <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>
</div>

<div class="post-container">
  <div class="post-row">
    <div class="user-profile">
      <img src="images/member-3.png">
      <div>
        <p> Nim</p>
        <span>April 15 at 9:48 AM · <i class="fa-solid fa-globe"></i></span>
      </div>
    </div>
    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
  </div>
  <p class="post-text">
    SUBSCRIBE <span>@EASY TUTORIALS</span> YouTube Channel for more updates
    <a href="#">YouTubeChannel</a>
  </p>
  <img src="images/feed-image-3.png" class="post-img">
  <div class="post-row">
    <div class="activity-icons">
      <div><img src="images/like-blue.png">120</div>
      <div><img src="images/comments.png">45</div>
      <div><img src="images/share.png">20</div>
    </div>
    <div class="post-profile-incon">
      <img src="images/profile-pic.png"> <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>
</div>

<div class="post-container">
  <div class="post-row">
    <div class="user-profile">
      <img src="images/member-6.png">
      <div>
        <p>Al</p>
        <span>April 15 at 9:48 AM · <i class="fa-solid fa-globe"></i></span>
      </div>
    </div>
    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
  </div>
  <p class="post-text">
    SUBSCRIBE <span>@EASY TUTORIALS</span> YouTube Channel for more updates
    <a href="#">YouTubeChannel</a>
  </p>
  <img src="images/feed-image-4.png" class="post-img">
  <div class="post-row">
    <div class="activity-icons">
      <div><img src="images/like-blue.png">120</div>
      <div><img src="images/comments.png">45</div>
      <div><img src="images/share.png">20</div>
    </div>
    <div class="post-profile-incon">
      <img src="images/profile-pic.png"> <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>
</div>

<div class="post-container">
  <div class="post-row">
    <div class="user-profile">
      <img src="images/member-8.png">
      <div>
        <p>Alisonim</p>
        <span>April 15 at 9:48 AM · <i class="fa-solid fa-globe"></i></span>
      </div>
    </div>
    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
  </div>
  <p class="post-text">
    SUBSCRIBE <span>@EASY TUTORIALS</span> YouTube Channel for more updates
    <a href="#">YouTubeChannel</a>
  </p>
  <img src="images/feed-image-5.png" class="post-img">
  <div class="post-row">
    <div class="activity-icons">
      <div><img src="images/like-blue.png">120</div>
      <div><img src="images/comments.png">45</div>
      <div><img src="images/share.png">20</div>
    </div>
    <div class="post-profile-incon">
      <img src="images/profile-pic.png"> <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>
</div>

<button type="button" class="load-more-btn">LOAD MORE</button>

    </div>

  </div>
</div>

<div class="footer">
  <p>Copyright © 2024 SocialBook. All Rights Reserved.</p>
</div>

<script src="scripte.js"></script>
</body>
</html>