<style>
    .row > * {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: 25px;
        padding-left: 25px;
        margin-top: var(--bs-gutter-y);
        border-radius: 5px
    }
    .bg-gray{
        background:#1f2938;
    }
    .bg-success{
        background-color: #00d25b;
        border-color: #00d25b;
        color: #fff;
    }
    .module-title{
        --tw-text-opacity: 1;
        color: rgb(243 244 246 / var(--tw-text-opacity));
        font-weight: 500;
        font-size: 1.125rem;
        line-height: 1.75rem;
        margin: 0;
    }
    .text-sm{
        font-size: .875rem;
        line-height: 1.25rem;
    }
    .block{
        display: block;
    }
    .w-full{
        width: 100%;
    }
    .w-color{
        color: white
    }
    .b-color{
        color: black
    }
    .g-color{
        color: #9ca3b0;
    }

</style>
<div class="container space-y-6">
    <div class="row">
        <div class="p-4 bg-gray">
            {{ $slot }}
        </div>
    </div>
</div>
