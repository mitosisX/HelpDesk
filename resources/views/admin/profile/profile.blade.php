@extends('admin.layout.app')

@section('title')
    <title>Profile - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <!-- START ISSUES CARD LIST-->
        <div class="columns is-desktop">
            <div class="column" style="margin-left: 200px;">
                <div class="columns  is-desktop has-text-centered">
                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">Active</p>
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
            <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Ticket name</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>City</th>
                        <th>Asignee</th>
                        <th>Priority</th>
                        <th>Due</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Name">12</td>
                        <td data-label="Company">Daugherty-Daniel</td>
                        <td data-label="City">South Cory</td>
                        <td data-label="Progress" class="is-progress-cell">
                            <progress max="100" class="progress is-small is-primary" value="79">79</progress>
                        </td>
                        <td data-label="Created">
                            <small class="has-text-grey is-abbr-like" title="Oct 25, 2020">Oct 25, 2020</small>
                        </td>
                        <td class="is-actions-cell">
                            <div class="buttons is-right">
                                <button class="button is-rounded is-small is-primary" type="button">
                                    <span class="icon"><i class="mdi mdi-eye"></i></span>
                                </button>
                                <button class="button is-rounded is-small is-danger jb-modal" data-target="sample-modal"
                                    type="button">
                                    <span class="icon"><i class="fab fa-facebook"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END ISSUES LIST -->
@endsection
