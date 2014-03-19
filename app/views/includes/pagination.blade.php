@if ($paginator->getLastPage() > 1)
<nav class="pagination" role="navigation">
      @if($paginator->getCurrentPage() == 1)
      <a class="prev disabled " href="javascript:void(0);" title="previous page">
      上一页
      </a>
      @else
      <a class="prev " href="{{ $paginator->getUrl($paginator->getCurrentPage()-1) }}" title="previous page">
      上一页
      </a>
      @endif
      @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
      <a href="{{ $paginator->getUrl($i) }}" {{ ($paginator->getCurrentPage() == $i) ? 'class=active' : '' }}>
          {{ $i }}
      </a>
      @endfor

      @if($paginator->getCurrentPage() == $paginator->getLastPage())
      <a class="next disabled" href="javascript:void(0);" >
          下一页
      </a>
      @else
      <a class="next {{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? 'disabled' : '' }}" href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" >
          下一页
      </a>
      @endif
</nav>
@endif
