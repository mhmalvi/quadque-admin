<template>
  <!-- Side Nav START -->
  <div class="side-nav">
    <div class="side-nav-inner">
      <ul class="side-nav-menu scrollable">
        <li class="active">
          <router-link to="/">
            <span class="icon-holder">
              <i class="anticon anticon-dashboard"></i>
            </span>
            <span class="title">Dashboard</span>
          </router-link>
        </li>

        <li>
          <router-link to="/categories">
            <span class="icon-holder">
              <i class="anticon anticon-tags"></i>
            </span>
            <span class="title">Categories</span>
          </router-link>
        </li>

        <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder">
              <i class="anticon anticon-align-left"></i>
            </span>
            <span class="title">Blogs</span>
            <span class="arrow">
              <i class="arrow-icon"></i>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <router-link to="/blogs">Manage blogs</router-link>
            </li>
            <li>
              <router-link to="/blogs/create">Create Blog</router-link>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder">
              <i class="anticon anticon-align-left"></i>
            </span>
            <span class="title">Settings</span>
            <span class="arrow">
              <i class="arrow-icon"></i>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <router-link to="/profile/edit">Edit Profile</router-link>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- Side Nav END -->
</template>
