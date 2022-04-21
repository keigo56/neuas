<div x-data="{ open : false, items : [], selected: null, select(item){ this.selected = item; $refs.select.value = item.value } }"
     x-init="
     $refs.select.querySelectorAll('option').forEach((el) =>{
         items.push({ value: el.value, text: el.innerHTML, disabled : el.hasAttribute('disabled') });
         if(el.hasAttribute('selected')){ selected = { value: el.value, text: el.innerHTML, disabled : el.hasAttribute('disabled') } }
     });
     if(selected === null){ selected = items[0] }
     $refs.customhtml.querySelectorAll('div[value]').forEach((el, index) => { items[index].html = el.innerHTML });
"
>
    <select x-ref="select"
            class="hidden"
            {{ $attributes->merge(['name' => '']) }}
    >
        {{ $options }}
    </select>
    <div class="hidden" x-ref="customhtml">
        {{ $customhtml }}
    </div>
    <div class="mt-1 relative">
        <button @click="open = !open"
                type="button"
                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand sm:text-sm"
                aria-haspopup="listbox"
                aria-expanded="true"
                aria-labelledby="listbox-label">
              <span class="flex items-center">
                  <span class="block truncate" x-html="selected.text"></span>
              </span>
              <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"
                         fill="currentColor"
                         aria-hidden="true">
                      <path fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"/>
                    </svg>
              </span>
        </button>
        <ul
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-show="open"
            @click.away="open = false"
            class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
            tabindex="-1"
            role="listbox"
            aria-labelledby="listbox-label"
            aria-activedescendant="listbox-option-3">

            <template x-for="item in items">
                <div class="group">
                    <li @click="if(!item.disabled) select(item)"
                        :class="item.disabled ? 'bg-gray-100 hover:cursor-not-allowed' : 'group-hover:bg-brand group-hover:text-white '"
                        class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9"
                        id="listbox-option-0"
                        role="option">
                        <div class="flex items-center w-full ">
                            <div class="font-normal w-full" x-html="item.html"></div>
                        </div>
                        <span
                            :class="item.disabled ? '' : 'group-hover:text-white'"
                            class="text-brand absolute inset-y-0 right-0 flex items-center pr-4" x-show="selected.value === item.value">
                          <svg class="h-5 w-5"
                               xmlns="http://www.w3.org/2000/svg"
                               viewBox="0 0 20 20"
                               fill="currentColor"
                               aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                  clip-rule="evenodd"/>
                          </svg>
                        </span>
                    </li>
                </div>
            </template>
        </ul>
    </div>
</div>
