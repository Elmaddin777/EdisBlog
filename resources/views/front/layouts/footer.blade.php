</div>
</div>

<hr>

<!-- Footer -->
<footer>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        @php 
          $socials = [
            'fb' => 'facebook',
            'ig' => 'instagram',
            'tw' => 'twitter',
            'gh' => 'github',
            'li' => 'linkedin',
            'yt' => 'youtube'
          ]
        @endphp
        <ul class="list-inline text-center">
          @foreach ($socials as $alias => $social)
            @if (!$config->$alias == null)
              <li class="list-inline-item">
                <a target="_blank" href="{{ $config->$alias }}">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-{{ $social }} fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            @endif
          @endforeach
      </ul>
      <p class="copyright text-muted">Copyright &copy; {{$config->title}} - {{ date('Y') }}</p>
    </div>
  </div>
</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('front/')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('front/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>

</body>

</html>
