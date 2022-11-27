@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
 <!-- ======= Breadcrumbs ======= -->
 <section class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="index.html">Home</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li>Blog Single</li>
      </ol>
      <h2>Blog Single</h2>

    </div>
  </section>
  <!-- End Breadcrumbs -->

  <!-- ======= Blog Single Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-12 entries">

          <article class="entry entry-single">

            <div class="entry-img">
              <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">{{$article[0]->title}}</h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-tags"></i> <a href="/news/categories/{{$article[0]->category}}">{{$article[0]->category}}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i>{{$article[0]->publishDate}}</li>
              </ul>
            </div>

            <div class="entry-content">
              {!!$article[0]->content!!}
            </div>

            <div class="entry-footer">
              <i class="bi bi-folder"></i>
              <ul class="cats">
                <li><a href="#">Business</a></li>
              </ul>

              <i class="bi bi-tags"></i>
              <ul class="tags">
                <li><a href="#">Creative</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>
            </div>

          </article><!-- End blog entry -->


@endsection