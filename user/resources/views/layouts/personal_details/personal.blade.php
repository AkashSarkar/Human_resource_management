 <div class="panel panel-profile no-bg">
        <div class="panel-heading overflow-h">
            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Personal Details</h2>
        </div>
        <div class="panel-body panelHolder">
            <table class="table table-light margin-bottom-0">
                <tbody>
                <tr>
                    <td>
                        <span class="primary-link">Name</span>
                    </td>
                    <td>
                      {{Auth::user()->name}}
                    </td>
                </tr>
                {{--<tr>--}}
                    <td>
                        <span class="primary-link">Father's Name</span>
                    </td>
                    <td>
                        {{Auth::user()->f_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="primary-link">DOB</span>
                    </td>
                    <td>
                        {{Auth::user()->dob}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="primary-link">Gender</span>
                    </td>
                    <td>
                        {{Auth::user()->gender}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="primary-link">Email</span>
                    </td>
                    <td>
                        {{Auth::user()->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="primary-link">Phone</span>
                    </td>
                    <td>
                        {{Auth::user()->phone}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="primary-link">Local Address</span>
                    </td>
                    <td>
                        {{Auth::user()->l_address}}
                    </td>
                </tr>																															<tr>
                    <td>
                        <span class="primary-link">Permanent Address</span>
                    </td>
                    <td>
                        {{Auth::user()->p_address}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>