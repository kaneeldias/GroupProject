<div class="row">
      <div class="col-md-6 col-md-offset-3 form_container">

          <div class="form_title">Add Lecture Hall</div>

          <form class="form_content">

              <div class="col-md-12 filler">
                  <div class="form_item col-md-4">
                      <span class="form_label">Hall ID</span>
                      <input class="form_input" type="text" placeholder="ID"/>
                  </div>

                  <div class="form_item col-md-8">
                      <span class="form_label">Hall Name</span>
                      <input  class="form_input" type="text" placeholder="Name"/>
                  </div class="form_item">
              </div>

                <div class="com-md-12 filler">
                    <div class="form_item col-md-6">
                        <span class="form_label">Hall Type</span>
                        <select class="form_input">
                            <option value="" disabled selected>Type</option>
                            <option value="lecture_hall">Lecture Hall</option>
                            <option value="lab">Lab</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form_item col-md-6">
                        <span class="form_label">Capacity</span>
                        <input class="form_input" type="number" placeholder="Capacity"/>
                    </div>
                </div>


              <div class="form_item col-md-3">
                  <button type="submit">Submit</button>
              </div>
          </form>
      </div>
</div>
