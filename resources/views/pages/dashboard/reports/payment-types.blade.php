@extends( 'layout.dashboard' )

@section( 'layout.dashboard.body' )
<div class="flex-auto flex flex-col">
    @include( Hook::filter( 'ns-dashboard-header', '../common/dashboard-header' ) )
    <div class="flex-auto flex flex-col" id="dashboard-content">
        <div class="px-4">
            <div class="page-inner-header mb-4">
                <h3 class="text-3xl text-gray-800 font-bold">{{ $title ?? __( 'Unamed Page' ) }}</h3>
                <p class="text-gray-600">{{ $description ?? __( 'No Description Provided' ) }}</p>
            </div>
        </div>
        <ns-payment-types-report inline-template v-cloak>
            <div id="report-section" class="px-4">
                <div class="flex -mx-2">
                    <div class="px-2">
                        <ns-datepicker :date="startDate" @change="setStartDate( $event )"></ns-datepicker>
                    </div>
                    <div class="px-2">
                        <ns-datepicker :date="endDate" @change="setEndDate( $event )"></ns-datepicker>
                    </div>
                    <div class="px-2">
                        <button @click="loadReport()" class="rounded flex justify-between bg-white shadow py-1 items-center text-gray-700 px-2">
                            <i class="las la-sync-alt text-xl"></i>
                            <span class="pl-2">Load</span>
                        </button>
                    </div>
                    <div class="px-2">
                        <button @click="printSaleReport()" class="rounded flex justify-between bg-white shadow py-1 items-center text-gray-700 px-2">
                            <i class="las la-print text-xl"></i>
                            <span class="pl-2">Print</span>
                        </button>
                    </div>
                </div>
                <div id="sale-report" class="anim-duration-500 fade-in-entrance">
                    <div class="flex w-full">
                        <div class="my-4 flex justify-between w-full">
                            <div class="text-gray-600">
                                <ul>
                                    <li class="pb-1 border-b border-dashed border-gray-200">{{ sprintf( __( 'Date : %s' ), ns()->date->getNowFormatted() ) }}</li>
                                    <li class="pb-1 border-b border-dashed border-gray-200">{{ __( 'Document : Sale Report' ) }}</li>
                                    <li class="pb-1 border-b border-dashed border-gray-200">{{ sprintf( __( 'By : %s' ), Auth::user()->username ) }}</li>
                                </ul>
                            </div>
                            <div>
                                <img class="w-72" src="{{ ns()->option->get( 'ns_store_rectangle_logo' ) }}" alt="{{ ns()->option->get( 'ns_store_name' ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded my-4">
                        <div class="border-b border-gray-200">
                            <table class="table w-full">
                                <thead class="text-gray-700">
                                    <tr>
                                        <th class="bg-gray-100 text-gray-700 border border-gray-300 p-2 text-left">{{ __( 'Summary' ) }}</th>
                                        <th width="150" class="text-gray-700 border border-green-200 bg-green-100 p-2 text-right">{{ __( 'Total' ) }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    <tr v-for="summary of report.summary" class="bg-gray-50 font-semibold">
                                        <td class="p-2 border border-gray-200">@{{ summary.label }}</td>
                                        <td class="p-2 border border-green-200 bg-green-100 text-right">@{{ summary.total | currency }}</td>
                                    </tr>
                                </tbody>
                                <tfoot class="text-gray-700 font-semibold">
                                    <tr>
                                        <td class="p-2 border border-gray-200 bg-gray-100 text-gray-700">{{ __( 'Total' ) }}</td>
                                        <td class="p-2 border border-green-200 bg-green-100 text-green-700 text-right">@{{ report.total | currency }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </ns-payment-types-report>
    </div>
</div>
@endsection