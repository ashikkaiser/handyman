<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel1">View Job Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-style">
                <tbody>
                    <tr>
                        <th style="width: 25%"> JOB ID </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> User Name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->user->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Company Name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->company ? $job->company->business_name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Category </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->category->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Sub Category </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->subcategory->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Start Time </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->start_time }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Name </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Description </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->description }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Email </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->email }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Phone </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->phone }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Postal Code </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->post_code }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Status </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->status }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%"> Created At </th>
                        <td style="width: 10%"> : </td>
                        <td style="width: 65%"> {{ $job->created_at->format('M d, Y') }}</td>
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
