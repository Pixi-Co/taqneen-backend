<div class="modal fade session-show-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color: #fafafa">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="session_resource.id">{{ __('show session') }}</h4>

            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-4">
                        <img src="{{ url('/images/sub/session.png') }}"
                            style="width: 100px;height: 100px;border-radius: 5em;background-color: white;margin: auto"
                            class="sb-shadow" alt="">
                        <br>
                        <br>
                        <ul class="w3-ul">
                            <li>
                                <i class="fa fa-id-card"></i> <span v-html="session_resource.id"></span>
                            </li>
                            <li>
                                <i class="fa fa-clock"></i> <span v-html="session_resource.name"></span>
                            </li>
                            <li>
                                <i class="fa fa-calendar"></i> <span v-html="session_resource.date_from"></span>
                            </li>
                            <li>
                                <i class="fa fa-calendar"></i> <span v-html="session_resource.date_to"></span>
                            </li>
                            <li v-if="session_resource.class_type">
                                <i class="fa fa-university"></i> <span v-html="session_resource.class_type.name"></span>
                            </li>
                            <li>
                                <i class="fa fa-users"></i> <span v-html="session_resource.group_number"></span>
                            </li>
                            <li v-if="session_resource.trainer">
                                <i class="fa fa-user-circle"></i> <span
                                    v-html="session_resource.trainer.full_name"></span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-8">
                        <h3>@trans('times')</h3>
                        @include("subscription::session.times")

                        <h3>@trans('members')</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@trans("id")</th>
                                    <th>@trans("name")</th>
                                    <th>@trans("phone")</th>
                                    <th>@trans("email")</th>
                                    <th>@trans("contacts")</th>
                                </tr>
                            </thead>
                            <tbody v-if="session_resource.members">
                                <tr v-for="member in session_resource.members">
                                    <td>
                                        <a href="#" v-html="member.id"></a>
                                    </td>
                                    <td>
                                        <span v-html="member.name"></span>
                                    </td>
                                    <td>
                                        <i class="fa fa-phone" v-if="member.mobile"
                                            v-on:click="window.open('tel:' + member.mobile)"></i>
                                        <span v-html="member.mobile"></span>
                                    </td>
                                    <td>
                                        <i class="fa fa-envelope" v-if="member.email"
                                            v-on:click="window.open('mailto:' + member.email)"></i>
                                        <span v-html="member.email"></span>
                                    </td>
                                    <td>
                                        <div style="min-width: 200px">
                                            <a target="_blank"
                                                v-if="member.mobile"
                                                v-bind:href="'https://api.whatsapp.com/send/?phone=' + member.mobile + '&app_absent=0'"
                                                style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
                                                class="btn w3-white w3-text-green material-shadow">
                                                <i  class="fab fa-whatsapp"></i>
                                            </a>
                                            <a target="_blank" 
                                                v-if="member.mobile" 
                                                v-bind:href="'tel:' + member.mobile"
                                                style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
                                                class="btn w3-white w3-text-indigo material-shadow">
                                                <i class="fas fa fa-phone"></i>
                                            </a>
                                            <a target="_blank" 
                                                v-if="member.email" 
                                                v-bind:href="'mailto:' + member.email"
                                                style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
                                                class="btn w3-white w3-text-purple material-shadow">
                                                <i class="fas fa fa-envelope"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-10">

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default w3-round-xlarge sb-shadow"
                    data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit"
                    class="btn btn-primary w3-round-xlarge sb-shadow">{{ __('Save changes') }}</button>
            </div>
        </div>
    </div>
</div>
