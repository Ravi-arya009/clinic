@props(['pageContentTitle' => 'Dashboard', 'search' => false])

<div class="dashboard-header">
    <div class="header-back">
        <h3>{{ $pageContentTitle }}</h3>
    </div>

    @if ($search)
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control customSearch" placeholder="Search">
                    <span class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <i class="fa-solid fa-xmark hide" style="cursor: pointer;"></i>
                    </span>
                </div>
            </li>
        </ul>
    @endif
</div>
