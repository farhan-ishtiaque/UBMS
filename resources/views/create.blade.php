<div class="mb-3">
    <label for="university">University</label>
    <select id="university" class="form-control" required>
        <option value="">Select University</option>
        @foreach($universities as $university)
            <option value="{{ $university->id }}">{{ $university->uni_name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="department_id">Department</label>
    <select name="department_id" id="department_id" class="form-control" required disabled>
        <option value="">Select a university first</option>
    </select>
</div>

<script>
    const universities = @json($universities);
    const departmentSelect = document.getElementById('department_id');
    const universitySelect = document.getElementById('university');

    universitySelect.addEventListener('change', function() {
        const selectedUniId = parseInt(this.value);
        departmentSelect.innerHTML = '<option value="">Select Department</option>';
        departmentSelect.disabled = true;

        if (selectedUniId) {
            const selectedUni = universities.find(u => u.id === selectedUniId);

            if (selectedUni && selectedUni.departments.length > 0) {
                selectedUni.departments.forEach(dept => {
                    const option = document.createElement('option');
                    option.value = dept.id;
                    option.textContent = dept.dept_name;
                    departmentSelect.appendChild(option);
                });
                departmentSelect.disabled = false;
            } else {
                departmentSelect.innerHTML = '<option value="">No departments found for this university</option>';
            }
        } else {
            departmentSelect.innerHTML = '<option value="">Select a university first</option>';
        }
    });
</script>
