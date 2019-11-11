<?php use App\Core\App; ?>
<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-sm-2 share-btn">

            <div class="id="fb-roo"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v4.0"></script>
            <div class="share fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button"
             data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;
             src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

        </div>

        <div class="col-sm-2 share-btn">

            <a href="<?php App::get('config')['share']['tw-link']?>" class="twitter-share-button" data-size="large" data-text="Check out this Meetup with SoCal AngularJS!"
               data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

        </div>

    </div>

    <div class="row justify-content-md-center">
        <div class="col-sm-3">
            <a id="members-btn" class="btn btn-info btn-lg active" role="button" aria-pressed="true" href="/members">All members</a>
        </div>
    </div>
</div>
