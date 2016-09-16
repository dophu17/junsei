<div class="my_pagination">
	{{ with(new App\Pagination\CustomPresenter($paginator))->render() }}
</div>