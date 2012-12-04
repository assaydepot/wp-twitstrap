<?php $search_query = get_search_query(); ?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="form-search">
  <fieldset>
    <div>
      <input type="text" value="<?php echo $search_query; ?>" name="s" id="s" class="input-medium search-query" placeholder="Enter search terms..." />
      <button type="submit" class="btn btn-info" id="searchsubmit"/>Search</button>
    </div>
  </fieldset>
</form>