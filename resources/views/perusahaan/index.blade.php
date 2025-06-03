@extends('layout.main')
@section('css')
@section('title', 'Setelan Perusahaan')
@section('container')
<div class="grid grid-flow-row gap-7">
    <div>
        <h2 class="text-lg font-semibold mb-4">Perusahaan Saya</h2>
        <img class="w-[120px] h-[120px] flex-none rounded-full overflow-hidden object-cover mb-2"
            src="assets/images/marvel.png" alt="">
        <p class="text-xs text-black/40 dark:text-white/40">Allowed file types: png, jpg, jpeg.</p>
    </div>
    <div class="relative">
        <input type="text" value="Cold Design" id="cold-design"
            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
            placeholder=" ">
        <label for="cold-design"
            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
            Nama Perusahaan
        </label>
    </div>
    <div class="relative">
        <input type="text" value="Client Relationship" id="relationship"
            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
            placeholder=" ">
        <label for="relationship"
            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
            Project Type
        </label>
    </div>
    <div class="relative">
        <textarea id="description"
            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
            placeholder=" ">Organize your thoughts with an outline. Here’s the outlining strategy I use. I promise it works like a charm. Not only will it make writing your blog post easier, it’ll help you make your message.
                                            </textarea>
        <label for="description"
            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
            Project Description
        </label>
    </div>
    <div class="relative">
        <div class="relative">
            <div for="due-date" class="absolute inset-y-0 left-0 flex items-center pt-[20px] pl-4 pointer-events-none">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.125 2.5V1.875C13.125 1.52982 13.4048 1.25 13.75 1.25C14.0952 1.25 14.375 1.52982 14.375 1.875V2.5H16.25C16.25 2.5 16.7678 2.5 17.1339 2.86612C17.1339 2.86612 17.5 3.23223 17.5 3.75V16.25C17.5 16.25 17.5 16.7678 17.1339 17.1339C17.1339 17.1339 16.7678 17.5 16.25 17.5H3.75C3.75 17.5 3.23223 17.5 2.86612 17.1339C2.86612 17.1339 2.5 16.7678 2.5 16.25V3.75C2.5 3.75 2.5 3.23223 2.86612 2.86612C2.86612 2.86612 3.23223 2.5 3.75 2.5H5.625V1.875C5.625 1.52982 5.90482 1.25 6.25 1.25C6.59518 1.25 6.875 1.52982 6.875 1.875V2.5H13.125ZM3.75 7.5V16.25H16.25V7.5H3.75ZM16.25 6.25H3.75V3.75H5.625V4.375C5.625 4.72018 5.90482 5 6.25 5C6.59518 5 6.875 4.72018 6.875 4.375V3.75H13.125V4.375C13.125 4.72018 13.4048 5 13.75 5C14.0952 5 14.375 4.72018 14.375 4.375V3.75H16.25V6.25Z"
                        fill="currentColor" fill-opacity="0.2"></path>
                </svg>
            </div>
            <input type="date" value="" id="due-date"
                class="block rounded-lg px-10 pb-4 pt-[38px] w-full text-sm text-black dark:text-white dark:bg-white/5 bg-white border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                placeholder="pick a date">
        </div>
        <label
            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
            Due Date
        </label>
    </div>
    <div
        class="relative rounded-lg px-5 py-4 w-full bg-white dark:bg-white/5 border border-black/10 dark:border-white/10">
        <p class="text-xs text-black/40 dark:text-white/40 mb-1.5">Manage Budget</p>
        <div class="flex items-center gap-6">
            <div class="flex items-center">
                <input id="email" type="checkbox" value=""
                    class="w-[18px] h-[18px] text-black bg-white border-black/20 dark:bg-black dark:border-white/20 rounded focus:ring-0 focus:outline-0 focus:outline-offset-0 focus:ring-offset-0">
                <label for="email" class="ml-2">Email</label>
            </div>
            <div class="flex items-center">
                <input id="phone" type="checkbox" value=""
                    class="w-[18px] h-[18px] text-black bg-white border-black/20 dark:bg-black dark:border-white/20 rounded focus:ring-0 focus:outline-0 focus:outline-offset-0 focus:ring-offset-0">
                <label for="phone" class="ml-2">Phone</label>
            </div>
        </div>
    </div>
    <div
        class="relative rounded-lg px-5 py-4 w-full bg-white dark:bg-black border border-black/10 dark:border-white/10">
        <p class="text-xs text-black/40 dark:text-white/40 mb-1.5">Allow Changes</p>
        <div class="togglebutton inline-block">
            <label for="toggleE" class="flex items-center cursor-pointer">
                <div class="relative">
                    <input type="checkbox" id="toggleE" class="sr-only">
                    <div class="block band bg-black/20 dark:bg-white/20 w-7 h-4 rounded-full"></div>
                    <div
                        class="dot absolute left-[1.5px] top-[2px] bg-white dark:bg-black w-3 h-3 rounded-full transition">
                    </div>
                </div>
                <div class="ml-1.5">Allowed</div>
            </label>
        </div>
    </div>
    <div
        class="-mx-7 -mb-7 border-t border-b border-black/10 dark:border-white/10 px-7 py-[18px] flex justify-end gap-4">
        <a href="javaScript:;" class="btn">Discard</a>
        <a href="javaScript:;" class="btn">Save Changes</a>
    </div>
</div>

@endsection