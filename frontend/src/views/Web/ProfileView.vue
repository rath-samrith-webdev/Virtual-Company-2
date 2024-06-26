<script setup lang="ts">
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { ref } from 'vue'
import { useTransition } from '@vueuse/core'
import {
  ChatLineRound,
  DataAnalysis,
  FirstAidKit,
  Location,
  Memo,
  Position,
  Search,
  Service,
  SuitcaseLine,
  User,
  View,
  Edit,
  Upload
} from '@element-plus/icons-vue'

</script>

<template>
  <WebLayout>
    <div class="container">
      <!-- ====================================== -->
      <!-- tabs to show Informatin   -->
      <!-- ====================================== -->
      <el-tabs type="border-card" class="main-card-border">
        <!-- <==== History tab ====> -->
        <el-tab-pane label="History" class="tabs">
          <!-- <==== card 1 ====> -->
          <el-card class="card">
            <el-descriptions
              class="margin-top"
              title="My name is Rath go to hospital first time"
              :column="3"
              :size="size"
              border
            >
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <user />
                    </el-icon>
                    Username
                  </div>
                </template>
                Rath
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <iphone />
                    </el-icon>
                    Telephone
                  </div>
                </template>
                123456789
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <location />
                    </el-icon>
                    Place
                  </div>
                </template>
                Cambodia
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <tickets />
                    </el-icon>
                    Remarks
                  </div>
                </template>
                <el-tag size="small">PNC</el-tag>
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <office-building />
                    </el-icon>
                    Address
                  </div>
                </template>
                No.1188, Wuzhong Avenue, Wuzhong District, Suzhou, Jiangsu Province
              </el-descriptions-item>
            </el-descriptions>
          </el-card>
          <!-- <==== card 2 ====> -->
          <el-card class="card">
            <el-descriptions
              class="margin-top"
              title="My name is Radit go to hospital first second time"
              :column="3"
              :size="size"
              border
            >
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <user />
                    </el-icon>
                    Username
                  </div>
                </template>
                Rath
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <iphone />
                    </el-icon>
                    Telephone
                  </div>
                </template>
                123456789
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <location />
                    </el-icon>
                    Place
                  </div>
                </template>
                Cambodia
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <tickets />
                    </el-icon>
                    Remarks
                  </div>
                </template>
                <el-tag size="small">PNC</el-tag>
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <office-building />
                    </el-icon>
                    Address
                  </div>
                </template>
                No.1188, Wuzhong Avenue, Wuzhong District, Suzhou, Jiangsu Province
              </el-descriptions-item>
            </el-descriptions>
          </el-card>
        </el-tab-pane>
        <!-- <==== personal Information tab ====> -->
        <el-tab-pane label="Persional Informatin">
          <el-card class="card">
            <div class="demo-type">
              <el-avatar :size="150" src="https://empty" @error="errorHandler">
                <img
                  src="https://media.licdn.com/dms/image/D5603AQFJJOAM6AAM-Q/profile-displayphoto-shrink_400_400/0/1704010367613?e=1724889600&v=beta&t=lT_OdIqbG4SCKpu95R71jbp9ZqEGVhglDVTitXqp7GA"
                />
              </el-avatar>
              <!-- <==== image for upload picture ====> -->
              <el-button type="warning">
                Upload<el-icon class="el-icon--right"><Upload /></el-icon>
              </el-button>
            </div>
            <el-descriptions
              class="margin-top"
              title="General Information"
              :column="3"
              :size="size"
              border
            >
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <user />
                    </el-icon>
                    First Name
                  </div>
                </template>
                Rath
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <user />
                    </el-icon>
                    Last Name
                  </div>
                </template>
                Samrath
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <iphone />
                    </el-icon>
                    Gender
                  </div>
                </template>
                Men
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <day />
                    </el-icon>
                    Date of Birth
                  </div>
                </template>
                2024-24-02
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <email />
                    </el-icon>
                    Email
                  </div>
                </template>
                rathsamrath@gmail.com
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <phone />
                    </el-icon>
                    Phone Number
                  </div>
                </template>
                +885 123456789
              </el-descriptions-item>
            </el-descriptions>
            <el-descriptions class="margin-top" title="Address " :column="3" :size="size" border>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <vilage />
                    </el-icon>
                    Vilage
                  </div>
                </template>
                Phom Penh
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <iphone />
                    </el-icon>
                    Street
                  </div>
                </template>
                #371
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <communce />
                    </el-icon>
                    Communce
                  </div>
                </template>
                O bek kaom
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <district />
                    </el-icon>
                    District
                  </div>
                </template>
                Sen Sok
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <province />
                    </el-icon>
                    Province
                  </div>
                </template>
                Phom Phenh
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <location />
                    </el-icon>
                    City
                  </div>
                </template>
                Phom Penh
              </el-descriptions-item>
            </el-descriptions>
            <el-descriptions class="margin-top" title="Others" :column="3" :size="size" border>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <user />
                    </el-icon>
                    Bloode Type
                  </div>
                </template>
                O+
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <iphone />
                    </el-icon>
                    Age
                  </div>
                </template>
                30
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <father />
                    </el-icon>
                    Father Name
                  </div>
                </template>
                Yaya
              </el-descriptions-item>
              <el-descriptions-item>
                <template #label>
                  <div class="cell-item">
                    <el-icon :style="iconStyle">
                      <tickets />
                    </el-icon>
                    Mother Name
                  </div>
                </template>
                Papa
              </el-descriptions-item>
            </el-descriptions>
          </el-card>
        </el-tab-pane>
      </el-tabs>
    </div>
  </WebLayout>
</template>


<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}
.main-card-border {
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-radius: 10px;
}
.card {
  width: 1200px;
  margin-top: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
}
.margin-top {
  background: linear-gradient(to right, rgba(252, 178, 45, 0.8), rgba(249, 125, 0, 0.2));
  margin: 10px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-size: 50px;
  margin-top: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
}
</style>

