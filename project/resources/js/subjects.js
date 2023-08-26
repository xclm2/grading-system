(function ($) {
    $.widget('xcl.subjects', {
        options: {
            token:null,
        },
        searchUrl: '/admin/subject/search/',
        deleteUrl: '/admin/subject/delete/',
        createUrl: '/admin/subject/save/',
        massDeleteUrl: '/admin/subject/massDelete/',
        _create: function() {
            var searchForm = this._getElement('#search-form');
            var createForm = this._getElement('#new-subject');
            var pagination = this._getElement('nav ul.pagination li');
            var self = this;

            this._fetchAll();

            $(searchForm).on('submit', function(e) {
                e.preventDefault();
                self._search($('#search_subject').val());
            });

            $(createForm).on('submit', function(e) {
                e.preventDefault();
                self.__create(this);
            });
        },

        __initDelete: function() {
            var self = this;
            var btn = this._getElement('.btn-subject-delete');
            $(btn).on('click', function() {
                self._delete($(this).attr('data-subject'))
            });
        },

        __initMassDelete: function() {
            var self = this;
            var massDelete = this._getElement('.js-subject-mass-delete');
            var inputField = this._getElement('input[name="subjects[]"]');
            var checkedSubjects = 'input[name="subjects[]"]:checked';
            $(massDelete).on('click', function() {
                var subjects = self._getElement(checkedSubjects);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        var ids = [];
                        subjects.each(function() {
                            ids.push($(this). val())
                        });

                        self._massDelete(ids);
                    }
                  })
            });

            $(inputField).on('click', function() {
                var selectedSubjects = self._getElement(checkedSubjects);
                if (selectedSubjects.length > 0) {
                    massDelete.removeAttr('disabled');
                }else {
                    massDelete.attr('disabled', true);
                }
            });

        },

        __initEdit: function() {
            var self = this;
            var btn = this._getElement('.js-update-subject');
            $(btn).on('click', function() {
                let id   = $(this).attr('data-id');
                let form = $('.edit-subject-' + id);
                // console.log(form.serialize());
                self._create(form);
                $('#subject-edit-' + id).modal('hide')
            });
        },

        __initPagination: function() {
            var self = this;
            var pagination = this._getElement('nav ul.pagination li');
            $(pagination).on('click', function(e) {
                e.preventDefault();

                let url = $(this).find('a').attr("href");
                let arr = url.split("=");
                let page = arr[arr.length - 1];

                self._search($('#search_subject').val(), page);
            });
        },

        _fetchAll: function() {
            var self = this;
            $.ajax({
                url: self.searchUrl,
                success: function(res) {
                    self._getTable().append(res);
                },
                complete: function() {
                    self.__initDelete();
                    self.__initPagination();
                    self.__initEdit();
                    self.__initMassDelete();
                }
            });
        },

        __create: function(form) {
            var self = this;
            self._toggleSpinner();
            $.post({
                url: self.createUrl,
                data: $(form).serialize(),
                success: function(res) {
                    self.makeToast('Added New Subject', 'success');
                    self._clearTable();
                    self._fetchAll();
                    self.__initMassDelete();
                },
                complete: function() {
                    self._toggleSpinner(false);
                }
            })
        },

        _delete: function (id) {
            var self = this;
            this._toggleSpinner();
            $.ajax({
                url: self.deleteUrl,
                type: "DELETE",
                data: {id:id, _token: self.options.token},
                success: function (res) {
                    self._clearTable();
                    self._fetchAll();
                    self.makeToast(res + " DELETED" , 'danger');
                    self._toggleSpinner(false);
                }
            })
        },

        _massDelete: function(ids) {
            var self = this;
            $.ajax({
                url: self.massDeleteUrl,
                type: "DELETE",
                data: {ids:ids, _token: self.options.token},
                success: function (res) {
                    Swal.fire(
                    'Deleted ' + ids.length + ' record(s)!',
                    '',
                    'success'
                    );
                },
                error: function(res) {
                    
                },
                complete: function() {
                    self._resetTable();
                }
            })
        },

        _resetTable: function() {
            this._clearTable();
            this._fetchAll();
            this.__initDelete();
            this.__initPagination();
            this.__initEdit();
            this.__initMassDelete();
        },
        _search: function (key, page = 1) {
            var self = this;
            this._toggleSpinner();
            $.ajax({
                url: this.searchUrl + key + '?page=' + page,
                success: function(res) {
                    self._clearTable();
                    self._getTable().append(res);
                    self.__initPagination();
                    self.__initEdit();
                    self.__initMassDelete();
                },
                complete: function() {
                    self.__initDelete();
                    self.__initEdit();
                    self._toggleSpinner(false);
                }
            })
        },

        _clearTable: function() {
            this._getTable().html("");
        },

        makeToast: function(msg, type) {
            var toast = window.createToast(msg, type);
            $(toast).toast('show');
        },

        _getTable: function () {
            return this._getElement('.js-subjects-table');
        },

        _toggleSpinner: function(display = true) {
            if (display) {
                $('.js-grading-spinner').fadeIn();
                return;
            }

            $('.js-grading-spinner').fadeOut();
        },
        
        _getElement: function(type) {
            return this.element.find(type);
        }
        
    });

})(jQuery);