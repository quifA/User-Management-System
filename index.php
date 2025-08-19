<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Manager</title>
  <style>
    :root{
      --bg:#f6f7fb;
      --card:#ffffff;
      --text:#1f2937;
      --muted:#6b7280;
      --primary:#2563eb;
      --primary-dark:#1e40af;
      --success:#16a34a;
      --success-dark:#15803d;
      --danger:#dc2626;
      --danger-dark:#b91c1c;
      --cyan:#0891b2;
      --cyan-dark:#0e7490;
      --border:#e5e7eb;
      --row:#f3f4f6;
    }
    *{box-sizing:border-box}
    body{
      margin:0; padding:40px 20px;
      font-family: "Segoe UI", Arial, sans-serif;
      background:var(--bg); color:var(--text);
    }
    .container{max-width:980px;margin:0 auto}
    h1{margin:0 0 18px;font-size:28px}
    .muted{color:var(--muted); font-size:14px}

    /* Card */
    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius:14px;
      box-shadow:0 8px 24px rgba(0,0,0,.06);
      padding:20px;
      margin-bottom:26px;
    }

    /* Form */
    .row{display:flex; gap:12px; flex-wrap:wrap; align-items:center}
    .field{
      display:flex; flex-direction:column; gap:6px; min-width:180px;
    }
    label{font-weight:600; font-size:14px}
    input[type="text"],input[type="number"]{
      padding:10px 12px; border:1px solid var(--border);
      border-radius:10px; background:#fff; outline:none;
    }
    .btn{
      display:inline-block; border:none; cursor:pointer;
      padding:10px 14px; border-radius:10px; font-weight:700;
      text-decoration:none; text-align:center;
    }
    .btn-success{ background:var(--success); color:#fff }
    .btn-success:hover{ background:var(--success-dark) }

    /* Table */
    .table-wrap{overflow:auto; border-radius:14px; border:1px solid var(--border)}
    table{width:100%; border-collapse:collapse; background:#fff}
    th,td{padding:12px 14px; text-align:center}
    thead th{
      background:linear-gradient(0deg, #eef2ff, #eaf0ff);
      color:#0f172a; font-weight:800; border-bottom:1px solid var(--border)
    }
    tbody tr:nth-child(even){ background:var(--row) }
    tbody td{ border-top:1px solid var(--border) }

    /* Action buttons */
    .btn-cyan{ background:var(--cyan); color:#fff }
    .btn-cyan:hover{ background:var(--cyan-dark) }
    .btn-danger{ background:var(--danger); color:#fff }
    .btn-danger:hover{ background:var(--danger-dark) }

    /* Badge */
    .badge{
      padding:6px 10px; border-radius:999px; font-weight:800; display:inline-block;
    }
    .badge-on{ background:#dcfce7; color:#065f46; border:1px solid #bbf7d0 }
    .badge-off{ background:#fee2e2; color:#7f1d1d; border:1px solid #fecaca }
  </style>
</head>
<body>
  <div class="container">
    <h1>User Manager</h1>
    <!-- Form Card -->
    <div class="card">
      <form class="row" action="insert.php" method="post">
        <div class="field">
          <label>Name</label>
          <input type="text" name="name" placeholder="e.g. Sarah" required>
        </div>
        <div class="field">
          <label>Age</label>
          <input type="number" name="age" placeholder="e.g. 22" min="1" required>
        </div>
        <div style="align-self:flex-end">
          <button class="btn btn-success" type="submit">Add User</button>
        </div>
      </form>
    </div>

    <!-- Table Card -->
    <div class="card">
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width:80px">ID</th>
              <th>Name</th>
              <th style="width:120px">Age</th>
              <th style="width:140px">Status</th>
              <th style="width:220px">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $res = $conn->query("SELECT id,name,age,status FROM users ORDER BY id ASC");
            if($res && $res->num_rows){
              while($r = $res->fetch_assoc()){
                $id = (int)$r['id'];
                $name = htmlspecialchars($r['name']);
                $age = (int)$r['age'];
                $status = (int)$r['status'];
                $badge = $status ? '<span class="badge badge-on">Active</span>' 
                                 : '<span class="badge badge-off">Inactive</span>';
                echo "<tr>
                        <td>{$id}</td>
                        <td>{$name}</td>
                        <td>{$age}</td>
                        <td>{$badge}</td>
                        <td>
                          <a class='btn btn-cyan' href='toggle.php?id={$id}'>Toggle</a>
                          <a class='btn btn-danger' href='delete.php?id={$id}' onclick=\"return confirm('Delete user #{$id}?');\">Delete</a>
                        </td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='5'>No users yet.</td></tr>";
            }
            $conn->close();
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
