global.EmployeeProgressBar = {
    progressBar: function (number) {
        let html = '';

        if (parseInt(number) === 100) {
            html += `
                <div class="progress-group">
                    <div class="progress-group-header align-items-end">
                        <div class="text-success"><span class="count" data-number="100">100</span>%</div>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            `;
        } else {
            html += `
                <div class="progress-group">
                     <div class="progress-group-header align-items-end">
                         <div class="text-warning"><span class="count" data-number="${number}">${number}</span>%</div>
                     </div>
                     <div class="progress-group-bars">
                         <div class="progress" style="height: 6px;">
                             <div class="progress-bar bg-warning" role="progressbar" style="width: ${number}%;" aria-valuenow="${number}" aria-valuemin="0" aria-valuemax="100"></div>
                         </div>
                     </div>
                </div>
            `;
        }

        return html;
    },

    elementState: function (status, element) {
        //finish
        if (status === 0) {
            element.removeClass('loading-btn');
            element.attr('disabled', false);
        }

        //loading
        if (status === 1) {
            element.addClass('loading-btn');
            element.attr('disabled', true);
        }
    },

    addLoadingContent(element) {
        element.addClass('loader');
    },

    removeLoadingContent(element) {
        element.removeClass('loader');
    }
};
