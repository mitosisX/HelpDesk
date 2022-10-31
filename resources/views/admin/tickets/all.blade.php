@extends('admin.layout.app')

@section('title')
    <title>Dashboard - Admin</title>
@endsection

<style>
    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .wrapper {
        height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        overflow: hidden;
    }

    .main-div {
        position: relative;
        margin: 10px;
        background-color: transparent;
    }

    .main-div1::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 50%;
        height: 50%;
        -webkit-box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        z-index: -1;
        -webkit-animation-name: yellow-shadow;
        animation-name: yellow-shadow;
        -webkit-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    .main-div1::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        width: 50%;
        height: 50%;
        -webkit-box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        z-index: -1;
        -webkit-animation-name: cyan-shadow;
        animation-name: cyan-shadow;
        -webkit-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    .main-div2::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        -webkit-box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        z-index: -1;
        -webkit-animation-name: gradient-shadow;
        animation-name: gradient-shadow;
        -webkit-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    .main-div3::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 50%;
        height: 100%;
        -webkit-box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        z-index: -1;
        -webkit-animation-name: half-yellow-shadow;
        animation-name: half-yellow-shadow;
        -webkit-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-duration: 5s;
        animation-duration: 5s;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    .main-div3::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        width: 50%;
        height: 100%;
        -webkit-box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        z-index: -1;
        -webkit-animation-name: half-cyan-shadow;
        animation-name: half-cyan-shadow;
        -webkit-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-duration: 5s;
        animation-duration: 5s;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    h1 {
        font-size: 50px;
        margin: 0;
        position: relative;
        z-index: 3;
        padding: 20px;
        background-color: #060C1F;
        color: #fff;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }

    @-webkit-keyframes yellow-shadow {
        0% {
            top: 0;
            left: 0;
        }

        25% {
            top: 50%;
            left: 0;
        }

        50% {
            top: 50%;
            left: 50%;
        }

        75% {
            top: 0;
            left: 50%;
        }

        100% {
            top: 0;
            left: 0;
        }
    }

    @keyframes yellow-shadow {
        0% {
            top: 0;
            left: 0;
        }

        25% {
            top: 50%;
            left: 0;
        }

        50% {
            top: 50%;
            left: 50%;
        }

        75% {
            top: 0;
            left: 50%;
        }

        100% {
            top: 0;
            left: 0;
        }
    }

    @-webkit-keyframes cyan-shadow {
        0% {
            right: 0;
            bottom: 0;
        }

        25% {
            right: 0;
            bottom: 50%;
        }

        50% {
            right: 50%;
            bottom: 50%;
        }

        75% {
            right: 50%;
            bottom: 0;
        }

        100% {
            right: 0;
            bottom: 0;
        }
    }

    @keyframes cyan-shadow {
        0% {
            right: 0;
            bottom: 0;
        }

        25% {
            right: 0;
            bottom: 50%;
        }

        50% {
            right: 50%;
            bottom: 50%;
        }

        75% {
            right: 50%;
            bottom: 0;
        }

        100% {
            right: 0;
            bottom: 0;
        }
    }

    @-webkit-keyframes gradient-shadow {
        0% {
            -webkit-box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
            box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
        }

        20% {
            -webkit-box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
            box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        }

        40% {
            -webkit-box-shadow: 0 0 17px 3px #0f0, 0 0 4px 2px #0f0;
            box-shadow: 0 0 17px 3px #0f0, 0 0 4px 2px #0f0;
        }

        60% {
            -webkit-box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
            box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        }

        80% {
            -webkit-box-shadow: 0 0 17px 3px #f00, 0 0 4px 2px #f00;
            box-shadow: 0 0 17px 3px #f00, 0 0 4px 2px #f00;
        }

        100% {
            -webkit-box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
            box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
        }
    }

    @keyframes gradient-shadow {
        0% {
            -webkit-box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
            box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
        }

        20% {
            -webkit-box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
            box-shadow: 0 0 17px 3px #0ff, 0 0 4px 2px #0ff;
        }

        40% {
            -webkit-box-shadow: 0 0 17px 3px #0f0, 0 0 4px 2px #0f0;
            box-shadow: 0 0 17px 3px #0f0, 0 0 4px 2px #0f0;
        }

        60% {
            -webkit-box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
            box-shadow: 0 0 17px 3px #ffff01, 0 0 4px 2px #ffff01;
        }

        80% {
            -webkit-box-shadow: 0 0 17px 3px #f00, 0 0 4px 2px #f00;
            box-shadow: 0 0 17px 3px #f00, 0 0 4px 2px #f00;
        }

        100% {
            -webkit-box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
            box-shadow: 0 0 17px 3px #C586C0, 0 0 4px 2px #C586C0;
        }
    }

    @-webkit-keyframes half-yellow-shadow {
        0% {
            top: 0;
            left: 0;
            height: 50%;
            width: 50%;
        }

        16.66% {
            top: 0;
            left: 0;
            height: 50%;
            width: 100%;
        }

        32.32% {
            top: 0;
            left: 50%;
            height: 50%;
            width: 50%;
        }

        49.98% {
            top: 50%;
            left: 50%;
            height: 50%;
            width: 50%;
        }

        66.64% {
            top: 50%;
            left: 0;
            height: 50%;
            width: 100%;
        }

        83.3% {
            top: 50%;
            left: 0;
            height: 50%;
            width: 50%;
        }

        100% {
            top: 0;
            left: 0;
            height: 50%;
            width: 50%;
        }
    }

    @keyframes half-yellow-shadow {
        0% {
            top: 0;
            left: 0;
            height: 50%;
            width: 50%;
        }

        16.66% {
            top: 0;
            left: 0;
            height: 50%;
            width: 100%;
        }

        32.32% {
            top: 0;
            left: 50%;
            height: 50%;
            width: 50%;
        }

        49.98% {
            top: 50%;
            left: 50%;
            height: 50%;
            width: 50%;
        }

        66.64% {
            top: 50%;
            left: 0;
            height: 50%;
            width: 100%;
        }

        83.3% {
            top: 50%;
            left: 0;
            height: 50%;
            width: 50%;
        }

        100% {
            top: 0;
            left: 0;
            height: 50%;
            width: 50%;
        }
    }

    @-webkit-keyframes half-cyan-shadow {
        0% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 50%;
        }

        16.66% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 100%;
        }

        32.32% {
            bottom: 0;
            right: 50%;
            height: 50%;
            width: 50%;
        }

        49.98% {
            bottom: 50%;
            right: 50%;
            height: 50%;
            width: 50%;
        }

        66.64% {
            bottom: 50%;
            right: 0;
            height: 50%;
            width: 100%;
        }

        83.3% {
            bottom: 50%;
            right: 0;
            height: 50%;
            width: 50%;
        }

        100% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 50%;
        }
    }

    @keyframes half-cyan-shadow {
        0% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 50%;
        }

        16.66% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 100%;
        }

        32.32% {
            bottom: 0;
            right: 50%;
            height: 50%;
            width: 50%;
        }

        49.98% {
            bottom: 50%;
            right: 50%;
            height: 50%;
            width: 50%;
        }

        66.64% {
            bottom: 50%;
            right: 0;
            height: 50%;
            width: 100%;
        }

        83.3% {
            bottom: 50%;
            right: 0;
            height: 50%;
            width: 50%;
        }

        100% {
            bottom: 0;
            right: 0;
            height: 50%;
            width: 50%;
        }
    }
</style>

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <!-- START ISSUES CARD LIST-->
        <div class="columns is-desktop">
            <div class="column" style="margin-left: 200px;">
                <div class="columns  is-desktop has-text-centered">
                    <div class="column is-2">
                        <div class="card main-div main-div3">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">New</p>
                                        <p class="title">02</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-active"></div>
                        </div>
                    </div>

                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">Open</p>
                                        <p class="title">56</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-open"></div>
                        </div>
                    </div>

                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">Closed</p>
                                        <p class="title">145</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-closed"></div>
                        </div>
                    </div>


                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle has-text-danger">Overdue</p>
                                        <p class="title has-text-danger">32</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-overdue"></div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- END ISSUES CARD LIST-->

        <div class="column box is-multiline">
            <table class="table is-fullheight is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Ticket name</th>
                        <th>Department</th>
                        <th>Asignee</th>
                        <th>Priority</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $ticket->name }}</td>
                            <td>{{ $ticket->department->name }}</td>
                            <td> sdsd</td>
                            <td>
                                @php
                                    $tagColor = $ticket->priority;
                                    
                                    $m = new \Moment\Moment($ticket->due_date);
                                @endphp

                                <span @class([
                                    'tag',
                                    'is-rounded',
                                    'is-success' => $tagColor == 'Low',
                                    'is-warning' => $tagColor == 'Medium',
                                    'is-danger' => $tagColor == 'High',
                                ])>{{ $ticket->priority }}</span>
                            </td>
                            <td>{{ $m->format('d F,Y') }}</td>
                            <td>
                                <div>
                                    <button class="button is-rounded is-small is-primary" type="button">
                                        <span class="icon">
                                            <i class="mdi mdi-eye"></i>
                                        </span>
                                    </button>
                                    <button class="button is-rounded is-small is-danger jb-modal" data-target="sample-modal"
                                        type="button">
                                        <span class="icon">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END ISSUES LIST -->
@endsection
