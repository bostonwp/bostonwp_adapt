<article class="hp-highlight">    
    <h2><a href="/blog/">Blog</a></h2>
    <p>Stay updated on WordPress <strong>news</strong> around Boston, and find <strong>videos</strong> and <strong>slides</strong> from past meet-ups.</p>
    <div class="recent">
     <?php if ($latest_post = bostonwp_get_latest_post()): ?>
        <?php //bostonwp_dump($latest_post) ?>
        <strong>Latest post&hellip;</strong> <a href="<?php echo get_permalink($latest_post->ID) ?>"><?php echo $latest_post->post_title ?></a>
     <?php else: ?>
        No new posts at this time.
     <?php endif; ?>
    </div>
    <a href="/blog/" class="arrow">Follow our Blog</a>
</article>
<article class="hp-highlight">    
<h2><a href="/forums/">Forums</a></h2>
    <p>Join the community discussion by <strong>asking questions</strong> and <strong>sharing ideas</strong> in the forums.</p>
    <div class="recent">
     <?php if ($latest_thread = bostonwp_get_latest_thread()): ?>
        <?php //bostonwp_dump($latest_thread) ?>
        <strong>Latest thread&hellip;</strong> <a href="/forums/topic/<?php echo $latest_thread->topic_slug ?>"><?php echo $latest_thread->topic_title ?></a>
     <?php else: ?>
        No new threads at this time.
     <?php endif; ?>
     <a href="/forums/" class="arrow">Visit the Forums</a>
    </div>
</article>
<article class="hp-highlight responsive-clear">    
    <h2><a href="/jobs/">Jobs</a></h2>
    <p>Browse the job board for WordPress <strong>work</strong> or post an ad to <strong>hire</strong> someone for your next job.</p>
    <div class="recent">
     <?php if ($latest_job = bostonwp_get_latest_job()): ?>
        <?php //bostonwp_dump($latest_job) ?>
        <strong>Latest job&hellip;</strong> <a href="<?php echo get_permalink($latest_job->ID) ?>"><?php echo $latest_job->post_title ?></a>
     <?php else: ?>
        No new jobs at this time.
     <?php endif; ?>
        <a href="/jobs/" class="arrow">View Jobs</a>
    </div>
</article>
<article class="hp-highlight remove-margin">    
      <h2><a href="http://meetup.bostonwp.org" rel="external">Meetup</a></h2>
      <p>Join us once a month to <strong>network</strong> with local WordPress users and attend <strong>learning sessions</strong>.</p>
      <div class="recent">
         <?php if ($latest_meetup = bostonwp_get_latest_meetup()): ?>
            <?php //bostonwp_dump($latest_meetup) ?>
            <strong>Latest meetup&hellip;</strong> <a href="<?php echo $latest_meetup['guid'] ?>" rel="external"><?php echo $latest_meetup['title'] ?></a>
         <?php else: ?>
            No new meetups at this time.
         <?php endif; ?>
        <a href="http://meetup.bostonwp.org" class="arrow" rel="external">Go to Meetup.com</a>
      </div>
</article>