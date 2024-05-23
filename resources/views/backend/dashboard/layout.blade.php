<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')
</head>

    <body>
        <div id="wrapper">
            @include('backend.dashboard.component.sidebar')

            <div id="page-wrapper" class="gray-bg">
                @include('backend.dashboard.component.nav')
                
                <div class="wrapper wrapper-content">
                    @include('backend.dashboard.component.ibox')
                    
                    @include($template)
                </div>

                @include('backend.dashboard.component.footer');
            </div>
        </div>
        @include('backend.dashboard.component.script')
    </body>
</html>
