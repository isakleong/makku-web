{{-- <div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-2 rounded-lg bg-yellow-100">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-black cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div style="position:fixed; bottom: 15px; left: 50%; transform: translate(-50%, 0); z-index: 99999; border-radius: 10px; background: #6776f4">
    <div class="px-6">
        <div class="p-2">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="flex-shrink-1 align-items-center d-inline-flex">
                    <div class="ml-3 me-3 text-white cookie-consent__message">{!! trans('cookie-consent::texts.message') !!}</div>
                </div>

                <div class="flex-shrink-0">
                    <button class="btn js-cookie-consent-agree cookie-consent__agree d-flex align-items-center justify-content-center" style="background: #243675; color: #fff;">{{ trans('cookie-consent::texts.agree') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

