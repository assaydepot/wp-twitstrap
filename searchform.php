<?php $search_query = get_search_query(); ?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="form-inline">
    <div class="form-group">
        <label class="sr-only" for="s">Search</label>
        <input type="search" value="<?php echo $search_query; ?>" name="s" id="s" class="form-control" placeholder="Enter search terms..." />
    </div>
    <button type="submit" class="btn btn-primary" id="searchsubmit">Search</button>
</form>