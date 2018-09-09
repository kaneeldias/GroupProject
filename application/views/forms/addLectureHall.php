<div class="row">
      <div class="col-md-4 col-md-offset-4 form_container">

          <div class="form_title">Add Lecture Hall</div>


          <form class="form_content">

             <div class="form_item">
                 <span class="form_label">Hall ID</span>
                 <input class="form_input" type="text" placeholder="ID"/>
             </div>

              <div class="form_item">
                  <span class="form_label">Hall Name</span>
                  <input  class="form_input" type="text" placeholder="Name"/>
              </div class="form_item">

              <div class="form_item">
                  <span class="form_label">Hall Type</span>
                  <select class="form_input">
                      <option value="" disabled selected>Type</option>
                      <option value="lecture_hall">Lecture Hall</option>
                      <option value="lab">Lab</option>
                      <option value="other">Other</option>
                  </select>
              </div>

              <div class="form_item">
                  <span class="form_label">Capacity</span>
                  <input class="form_input" type="number" placeholder="Capacity"/>
              </div>

              <div class="form_item">
                  <button type="submit">Submit</button>
              </div>

          </form>
      </div>
</div>
