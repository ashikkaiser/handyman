<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel1">View Review Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-style">
                <tbody>
                    <tr>
                        <th style="width: 25%"> Review ID </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> User Name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->user->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Company Name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->company->business_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Category name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->category->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Job name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->job_name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> review title </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->review_title ? $review->review_title : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Review </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->review }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Phone </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->phone }}</td>
                    </tr>
                    <tr>
                        @if ($review->carried_out == 0)
                            <th style="width: 25%"> Score </th>
                            <td style="width: 10%"> : </td>
                            <td style="width: 65%">
                                Workmanship = {{ $review->workmanship }} <br>
                                Tidiness = {{ $review->tidiness }} <br>
                                Reliability = {{ $review->reliability }} <br>
                                Courtesy = {{ $review->courtesy }} <br>
                            </td>
                        @else
                            <th style="width: 25%"> Score </th>
                            <td style="width: 10%"> : </td>
                            <td style="width: 65%">Overall = {{ $review->workmanship }}</td>
                        @endif

                    </tr>
                    <tr>
                        <th style="width: 25%"> Published </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $review->published ? 'Yes' : 'NO' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
        Close
    </button>
</div>
