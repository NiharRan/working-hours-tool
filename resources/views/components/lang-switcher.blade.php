<div class="text-right">
    <select id="lang-changer" class="border mr-1" value="{{ session()->get('local') }}">
        <option value="">{{ __('Choose') }}</option>
        <option value="en">English</option>
        <option value="fi">Finnish</option>
    </select>
    <form action="/change-local" id="lang-changer-form" method="post">
        <input type="hidden" name="local" id="local">
        @csrf
    </form>
    <script>
        const langSwitcher = document.querySelector('#lang-changer')
        const langSwitcherForm = document.querySelector('#lang-changer-form')
        const localField = document.querySelector('#local')
        langSwitcher.addEventListener('change', () => {
            localField.value = langSwitcher.value
            langSwitcherForm.submit()
        })
    </script>
</div>
