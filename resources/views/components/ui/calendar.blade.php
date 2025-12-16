<div class="mt-5" id="home_calendar" v-cloak>
    <div>
        <div class="intro-x flex items-center h-10">
            <h2 class="text-xl mb-5 font-bold truncate me-5">
                {{ t_('Schedules') }}
            </h2>
        </div>
        <div class="intro-x box">
            <div class="p-5">
                <div class="flex">
                    <a @click="previousMonth" href="javascript:;">
                        <i data-feather="chevron-right" class="w-5 h-5
                text-gray-600"></i>
                    </a>

                    <div class="font-medium mx-auto">@{{ MONTH_NAMES[current_month] }}
                    </div>
                    <a @click="nextMonth" href="javascript:;">
                        <i data-feather="chevron-left" class="w-5 h-5 text-gray-600"></i>
                    </a>
                </div>
                <div class="grid grid-cols-7 gap-4 mt-5 text-center">
                    <div v-for="(day,idx) in DAYS" :key="'day'+idx" class="font-medium">@{{ day }}
                    </div>
                    <div v-for="(item,idx) in month_days" :key="'day_month_'+idx"
                         @click="selectDay(item.day)"
                         :class="['py-3 bg-gray-100 cursor-pointer rounded relative',dayClasses(item.day)]">
                    <span class="inline-flex items-center justify-center px-2 py-1 me-2 text-xs
                    font-bold leading-none text-xl rounded-full">@{{ item.day }}</span>
                        <span v-if="item.badged"
                              class="inline-flex items-center justify-center px-2 py-1 me-2 text-xs font-bold leading-none rounded-full text-red-100 bg-red-600">@{{ item.activities }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
