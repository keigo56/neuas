<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>NEU APPOINTMENT SYSTEM</title>
</head>
<body style="margin: 0; overflow: hidden">
        <div style="font-family: Arial,serif; -webkit-font-smoothing: antialiased; overflow-x: hidden; background-color: rgb(241 245 249); padding: 1.25rem; width: 100%; height: 100vh"
    >
        <div style="border-radius: 0.25rem; background-color: white; max-width: 28rem; margin-left: auto; margin-right: auto; width: 100%; border: 1px solid #eee"
        >
            <div style="padding: 1.5rem 2rem;"
            >
                <div>
                    <img style="
                          display: block;
                          height: 5.5rem;
                          width: auto;
                          margin-left: auto;
                          margin-right: auto;
                          margin-bottom: 0.7rem;
                    "
                         src="https://neu.edu.ph/main/assets/images/logos/NEU%20Logo%20png.png"
                         alt="logo"
                    >
                    </img>
                    <h1
                        style="text-transform: uppercase;
                        font-size: 0.875rem;
                        line-height: 1.25rem;
                        font-weight: 600;
                        text-align: center;
                        margin-bottom: 2rem;
                            "
                        class="uppercase text-sm font-semibold text-center"
                    >NEU Appointment System
                    </h1>
                </div>

                <div class="mt-8 text-center">
                    <h1
                        style="
                            font-size: 1.25rem;
                            line-height: 1.75rem;
                            font-weight: 600;
                            text-align: center;
                            margin: 0;
                         "
                        class="text-xl font-semibold text-center mb-2">
                        Appointment Status
                    </h1>
                    <p style="
                             margin: 0;
                             font-size: 0.875rem;
                             line-height: 1.25rem;
                             color: rgb(113 113 122);
                             text-align: center;
                        ">
                        Hi {{ $student_name }},
                        @if($status === 'cancelled')
                            your appointment has been cancelled.
                        @else
                            your appointment has been set to {{ $status }}.
                        @endif
                    </p>
                </div>

                @if($notes !== '')
                    <div style="margin-top: 2.5rem;">
                        <h1 style="
                              font-size: 1.25rem;
                              line-height: 1.75rem;
                              text-align: left;
                              margin: 0;
                        "
                            class="text-md font-semibold text-left">Reason:</h1>
                        <div class="text-sm text-zinc-500 mt-2"
                             style="
                             margin: 0;
                             font-size: 0.875rem;
                             line-height: 1.25rem;
                             color: rgb(113 113 122);

                        "
                        >{{ $notes }}</div>
                    </div>
                @endif

                <div style="margin-top: 2.5rem;">
                    <h1 class="text-md font-semibold text-left mb-5"
                        style="
                              font-size: 1.25rem;
                              line-height: 1.75rem;
                              text-align: left;
                              margin: 0;
                        "
                    >Appointment Details:</h1>
                    <table style="width: 100%; margin-top: 1rem">
                        <tr>
                            <td>
                                <p style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                    margin: 0;
                                "
                                    class="text-sm font-medium text-gray-500"
                                >Name</p>
                            </td>
                            <td style="text-align: right">
                                <p style="margin:0"
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $student_name }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                    margin: 0;
                                "
                                     class="text-sm font-medium text-gray-500"
                                >Department</p>
                            </td>
                            <td style="text-align: right">
                                <p  style="margin:0"
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $department_name }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                "
                                     class="text-sm font-medium text-gray-500"
                                >Documents</div>
                            </td>
                            <td style="text-align: right">
                                @foreach($documents as $document)
                                    <p  style="margin:0"
                                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $document }}
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                "
                                     class="text-sm font-medium text-gray-500"
                                >Date</div>
                            </td>
                            <td style="text-align: right">
                                <p  style="margin:0"
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                >
                                    {{ $appointment_date }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                "
                                     class="text-sm font-medium text-gray-500"
                                >Time</div>
                            </td>
                            <td style="text-align: right">
                                <p  style="margin:0"
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $time_schedule }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-size: 0.875rem;
                                    line-height: 1.25rem;
                                    font-weight: 500;
                                    color: #6B7280;
                                "
                                     class="text-sm font-medium text-gray-500"
                                >Status</div>
                            </td>
                            <td style="text-align: right">
                                <p  style="margin-top: 0; margin-bottom: 0.5rem"
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if($status === 'cancelled')
                                        <span
                                            style="border-radius: 9999px; padding: 0.125rem 0.5rem; background-color: #FECDD3; color: #E11D48"
                                            class='ml-1 text-xs text-rose-600 truncate px-2 py-0.5 rounded-full bg-rose-200'>
                                        {{ $status }}
                                        </span>
                                    @else
                                        <span
                                            style="border-radius: 9999px; padding: 0.125rem 0.5rem; background-color: #bbf7d0; color: #16A34A"
                                            class='ml-1 text-xs text-rose-600 truncate px-2 py-0.5 rounded-full bg-rose-200'>
                                        {{ $status }}
                                        </span>
                                    @endif
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="margin-top: 2.5rem;">
                    <div class="text-center" style="text-align: center">
                        <div class="text-sm text-center text-gray-700 mt-12">Want to set a new appointment? <a href="{{ route('login') }}" class="text-brand text-sm font-semibold hover:text-brand-dark hover:underline ">Log In</a></div>
                    </div>
                </div>

                <div class="text-xs text-center text-zinc-400 mt-12" style="text-align: center">2022 NEU, All rights Reserved</div>
            </div>
        </div>
    </div>
</body>
</html>
